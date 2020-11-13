<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Command\Middleware;

use JasonBenett\CQRS\Command\CommandResponseInterface;
use JasonBenett\CQRS\Middleware\BusMiddlewareInterface;

interface CommandBusMiddlewareInterface extends BusMiddlewareInterface
{
    public function dispatch(object $subject): CommandResponseInterface;
}