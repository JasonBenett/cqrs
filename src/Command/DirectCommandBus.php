<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Command;

use JasonBenett\CQRS\Command\Exception\CommandHandlerNotFoundException;
use JasonBenett\CQRS\Command\Middleware\CommandBusMiddlewareInterface;

class DirectCommandBus implements CommandBusMiddlewareInterface
{
    /** @var CommandHandlerInterface[] */
    private array $handlers;

    public function __construct(CommandHandlerInterface ...$handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(object $subject): CommandResponseInterface
    {
        $subjectClass = get_class($subject);
        $handler      = $this->handlers[$subjectClass] ?? null;

        if (null === $handler) {
            throw new CommandHandlerNotFoundException($subject);
        }

        return $handler->handle($subject);
    }
}