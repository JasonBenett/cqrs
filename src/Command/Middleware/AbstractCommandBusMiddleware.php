<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Command\Middleware;

use JasonBenett\CQRS\Command\CommandBusInterface;
use JasonBenett\CQRS\Command\CommandResponseInterface;

abstract class AbstractCommandBusMiddleware implements CommandBusInterface
{
    private CommandBusInterface $bus;

    protected static array $state = [];

    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
    }

    final public function dispatch(object $command): CommandResponseInterface
    {
        $this->preDispatch($command);

        $response = $this->bus->dispatch($command);

        $this->postDispatch($command, $response);

        return $response;
    }

    public function preDispatch(object $command): void
    {
    }

    public function postDispatch(object $command, CommandResponseInterface $response): void
    {
    }
}