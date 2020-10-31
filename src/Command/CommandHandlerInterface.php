<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Command;

interface CommandHandlerInterface
{
    public function handle(object $command): void;

    public function listenTo(): string;
}