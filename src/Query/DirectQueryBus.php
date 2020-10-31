<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Query;

use JasonBenett\CQRS\Query\Exception\QueryHandlerNotFoundException;

class DirectQueryBus implements QueryBusInterface
{
    /** @var QueryHandlerInterface[] */
    private array $handlers;

    public function __construct(QueryHandlerInterface ...$handlers)
    {
        $this->handlers = $handlers;
    }

    public function handle(object $query): QueryResponseInterface
    {
        foreach ($this->handlers as $handler) {
            if ($handler->listenTo() === get_class($query)) {
                return $handler->handle($query);
            }
        }

        throw new QueryHandlerNotFoundException($query);
    }
}