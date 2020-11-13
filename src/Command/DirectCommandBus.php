<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Command;

use JasonBenett\CQRS\Command\Exception\CommandHandlerNotFoundException;

class DirectCommandBus implements CommandBusInterface
{
    /** @var CommandHandlerInterface[] */
    private array $handlers;

    public function __construct(CommandHandlerInterface ...$handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(object $command): CommandResponseInterface
    {
        $subjectClass = get_class($command);
        $handler      = $this->handlers[$subjectClass] ?? null;

        if (null === $handler) {
            throw new CommandHandlerNotFoundException($command);
        }

        return $handler->handle($command);
    }
}