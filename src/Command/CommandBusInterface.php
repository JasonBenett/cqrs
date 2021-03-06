<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Command;

interface CommandBusInterface
{
    public function dispatch(object $command): CommandResponseInterface;
}