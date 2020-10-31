<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Query\Exception;

use RuntimeException;

class QueryHandlerNotFoundException extends RuntimeException
{
    public function __construct(object $query)
    {
        parent::__construct(sprintf('The %s query is not handled.', get_class($query)));
    }
}