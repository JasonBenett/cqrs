<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Middleware;

use JasonBenett\CQRS\Response\ResponseInterface;

interface BusMiddlewareInterface
{
    public function dispatch(object $subject): ResponseInterface;
}