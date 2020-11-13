<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Query;

use JasonBenett\CQRS\Query\Exception\QueryHandlerNotFoundException;
use JasonBenett\CQRS\Query\Middleware\QueryBusMiddlewareInterface;

class DirectQueryBus implements QueryBusMiddlewareInterface
{
    /** @var QueryHandlerInterface[] */
    private array $handlers;

    public function __construct(QueryHandlerInterface ...$handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(object $subject): QueryResponseInterface
    {
        $subjectClass = get_class($subject);
        $handler      = $this->handlers[$subjectClass] ?? null;

        if (null === $handler) {
            throw new QueryHandlerNotFoundException($subject);
        }

        return $handler->handle($subject);
    }
}