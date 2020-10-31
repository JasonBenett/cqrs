<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Tests\Query;

use JasonBenett\CQRS\Query\DirectQueryBus;
use JasonBenett\CQRS\Query\Exception\QueryHandlerNotFoundException;
use JasonBenett\CQRS\Query\QueryHandlerInterface;
use JasonBenett\CQRS\Query\QueryResponseInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @coversDefaultClass \JasonBenett\CQRS\Query\DirectQueryBus
 */
class DirectQueryBusTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::handle
     */
    public function testHandle(): void
    {
        $query = new stdClass();

        $handlers = [
            $relevantHandler = $this->createMock(QueryHandlerInterface::class),
        ];

        $response = $this->createMock(QueryResponseInterface::class);

        $relevantHandler->expects(self::once())
            ->method('listenTo')
            ->willReturn(get_class($query));

        $relevantHandler->expects(self::once())
            ->method('handle')
            ->with($query)
            ->willReturn($response);

        $sut = new DirectQueryBus(...$handlers);
        $sut->handle($query);
    }

    /**
     * @covers ::__construct
     * @covers ::handle
     */
    public function testHandleFailure(): void
    {
        $query = new stdClass();

        $handlers = [
            $irrelevantHandler = $this->createMock(QueryHandlerInterface::class),
        ];

        $irrelevantHandler->expects(self::once())
            ->method('listenTo')
            ->willReturn('whatever');

        $irrelevantHandler->expects(self::never())
            ->method('handle');

        $this->expectException(QueryHandlerNotFoundException::class);

        $sut = new DirectQueryBus(...$handlers);
        $sut->handle($query);
    }
}