<?php

namespace JeffersonGoncalves\Commerce\Core\Workflow;

/**
 * Carries the workflow input plus the accumulated results of executed steps.
 * Steps read prior results and the original input from here.
 */
class WorkflowContext
{
    /**
     * @var array<string, mixed>
     */
    protected array $results = [];

    /**
     * @param  array<string, mixed>  $input
     */
    public function __construct(
        public readonly array $input = [],
    ) {}

    public function setResult(string $step, mixed $value): void
    {
        $this->results[$step] = $value;
    }

    public function result(string $step): mixed
    {
        return $this->results[$step] ?? null;
    }

    /**
     * @return array<string, mixed>
     */
    public function results(): array
    {
        return $this->results;
    }
}
