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

    public function handle(object $command): CommandResponseInterface
    {
        foreach ($this->handlers as $handler) {
            if ($handler->listenTo() === get_class($command)) {
                return $handler->handle($command);
            }
        }

        throw new CommandHandlerNotFoundException($command);
    }
}