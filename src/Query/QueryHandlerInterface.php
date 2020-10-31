<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Query;

interface QueryHandlerInterface
{
    public function handle(object $query): QueryResponseInterface;

    public function listenTo(): string;
}