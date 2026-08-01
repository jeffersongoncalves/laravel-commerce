<?php

use JeffersonGoncalves\Commerce\Core\Workflow\Step;
use JeffersonGoncalves\Commerce\Core\Workflow\Workflow;
use JeffersonGoncalves\Commerce\Core\Workflow\WorkflowContext;
use JeffersonGoncalves\Commerce\Core\Workflow\WorkflowException;

function recordingStep(array &$log, string $tag, bool $fail = false): Step
{
    return new class($log, $tag, $fail) extends Step
    {
        public function __construct(private array &$log, private string $tag, private bool $fail) {}

        public function handle(WorkflowContext $context): string
        {
            $this->log[] = "do:{$this->tag}";

            if ($this->fail) {
                throw new RuntimeException("boom:{$this->tag}");
            }

            return $this->tag;
        }

        public function compensate(mixed $result, WorkflowContext $context): void
        {
            $this->log[] = "undo:{$this->tag}";
        }

        public function name(): string
        {
            return $this->tag;
        }
    };
}

it('runs every step and collects results', function () {
    $log = [];
    $context = (new Workflow)
        ->addStep(recordingStep($log, 'a'))
        ->addStep(recordingStep($log, 'b'))
        ->run(['x' => 1]);

    expect($log)->toBe(['do:a', 'do:b'])
        ->and($context->result('a'))->toBe('a')
        ->and($context->result('b'))->toBe('b')
        ->and($context->input)->toBe(['x' => 1]);
});

it('compensates executed steps in reverse on failure', function () {
    $log = [];

    $workflow = (new Workflow)
        ->addStep(recordingStep($log, 'a'))
        ->addStep(recordingStep($log, 'b'))
        ->addStep(recordingStep($log, 'c', fail: true));

    expect(fn () => $workflow->run())->toThrow(WorkflowException::class);

    expect($log)->toBe(['do:a', 'do:b', 'do:c', 'undo:b', 'undo:a']);
});
