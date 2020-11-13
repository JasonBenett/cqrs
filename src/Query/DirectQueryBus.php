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
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(object $query): QueryResponseInterface
    {
        $subjectClass = get_class($query);
        $handler      = $this->handlers[$subjectClass] ?? null;

        if (null === $handler) {
            throw new QueryHandlerNotFoundException($query);
        }

        return $handler->handle($query);
    }
}