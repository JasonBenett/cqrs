<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Query\Middleware;

use JasonBenett\CQRS\Query\QueryBusInterface;
use JasonBenett\CQRS\Query\QueryResponseInterface;

abstract class AbstractQueryBusMiddleware implements QueryBusInterface
{
    private QueryBusInterface $bus;

    protected static array $state = [];

    public function __construct(QueryBusInterface $bus)
    {
        $this->bus = $bus;
    }

    final public function dispatch(object $query): QueryResponseInterface
    {
        $this->preDispatch($query);

        $response = $this->bus->dispatch($query);

        $this->postDispatch($query, $response);

        return $response;
    }

    public function preDispatch(object $query): void
    {
    }

    public function postDispatch(object $query, QueryResponseInterface $response): void
    {
    }
}