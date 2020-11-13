<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Middleware;

use JasonBenett\CQRS\Response\ResponseInterface;

abstract class AbstractMiddleware implements BusMiddlewareInterface
{
    private BusMiddlewareInterface $middleware;

    protected static $state = [];

    public function __construct(BusMiddlewareInterface $middleware)
    {
        $this->middleware = $middleware;
    }

    final public function dispatch(object $subject): ResponseInterface
    {
        $this->preDispatch($subject);

        $response = $this->middleware->dispatch($subject);

        $this->postDispatch($subject, $response);

        return $response;
    }

    public function preDispatch(object $subject): void
    {
    }

    public function postDispatch(object $subject, ResponseInterface $response): void
    {
    }
}