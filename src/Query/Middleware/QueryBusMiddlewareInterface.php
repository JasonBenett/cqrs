<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Query\Middleware;

use JasonBenett\CQRS\Middleware\BusMiddlewareInterface;
use JasonBenett\CQRS\Query\QueryResponseInterface;

interface QueryBusMiddlewareInterface extends BusMiddlewareInterface
{
    public function dispatch(object $subject): QueryResponseInterface;
}