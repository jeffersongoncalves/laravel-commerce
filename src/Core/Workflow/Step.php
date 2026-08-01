<?php

namespace JeffersonGoncalves\Commerce\Core\Workflow;

/**
 * A single unit of work in a workflow. `handle()` performs the action and its
 * return value is stored in the context; `compensate()` undoes it when a later
 * step fails (saga pattern).
 */
abstract class Step
{
    abstract public function handle(WorkflowContext $context): mixed;

    public function compensate(mixed $result, WorkflowContext $context): void
    {
        // No-op by default; override to roll back side effects.
    }

    public function name(): string
    {
        return static::class;
    }
}
