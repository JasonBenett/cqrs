<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Command;

interface CommandHandlerInterface
{
    public function handle(object $command): CommandResponseInterface;

    public function listenTo(): string;
}