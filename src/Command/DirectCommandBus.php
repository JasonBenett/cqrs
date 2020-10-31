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
        $this->handlers = $handlers;
    }

    public function handle(object $command): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler->listenTo() === get_class($command)) {
                $handler->handle($command);

                return;
            }
        }

        throw new CommandHandlerNotFoundException($command);
    }
}