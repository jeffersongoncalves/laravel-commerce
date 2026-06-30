<?php

namespace JeffersonGoncalves\Commerce\Core\Workflow;

use RuntimeException;
use Throwable;

class WorkflowException extends RuntimeException
{
    public function __construct(
        public readonly string $failedStep,
        Throwable $previous,
    ) {
        parent::__construct(
            "Workflow step [{$failedStep}] failed: {$previous->getMessage()}",
            (int) $previous->getCode(),
            $previous,
        );
    }
}
