<?php

namespace JeffersonGoncalves\Commerce\Core\Workflow;

use Throwable;

/**
 * Orchestrates an ordered list of steps. On failure, already-executed steps are
 * compensated in reverse order, then a WorkflowException is thrown — giving
 * cross-system consistency without a distributed transaction.
 */
class Workflow
{
    /**
     * @var array<int, Step>
     */
    protected array $steps = [];

    public function addStep(Step $step): static
    {
        $this->steps[] = $step;

        return $this;
    }

    /**
     * @param  array<string, mixed>  $input
     */
    public function run(array $input = []): WorkflowContext
    {
        $context = new WorkflowContext($input);

        /** @var array<int, array{step: Step, result: mixed}> $executed */
        $executed = [];

        foreach ($this->steps as $step) {
            try {
                $result = $step->handle($context);
            } catch (Throwable $e) {
                $this->compensate($executed, $context);

                throw new WorkflowException($step->name(), $e);
            }

            $context->setResult($step->name(), $result);
            $executed[] = ['step' => $step, 'result' => $result];
        }

        return $context;
    }

    /**
     * @param  array<int, array{step: Step, result: mixed}>  $executed
     */
    protected function compensate(array $executed, WorkflowContext $context): void
    {
        foreach (array_reverse($executed) as $entry) {
            try {
                $entry['step']->compensate($entry['result'], $context);
            } catch (Throwable) {
                // Best-effort rollback; keep compensating the remaining steps.
            }
        }
    }
}
