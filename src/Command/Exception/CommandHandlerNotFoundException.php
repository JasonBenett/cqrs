<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Command\Exception;

use RuntimeException;

class CommandHandlerNotFoundException extends RuntimeException
{
    public function __construct(object $command)
    {
        parent::__construct(sprintf('The %s command is not handled.', get_class($command)));
    }
}