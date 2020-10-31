<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Query;

interface QueryBusInterface
{
    public function handle(object $query): QueryResponseInterface;
}