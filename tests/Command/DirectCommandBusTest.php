<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Tests\Command;

use JasonBenett\CQRS\Command\CommandHandlerInterface;
use JasonBenett\CQRS\Command\CommandResponseInterface;
use JasonBenett\CQRS\Command\DirectCommandBus;
use JasonBenett\CQRS\Command\Exception\CommandHandlerNotFoundException;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @coversDefaultClass \JasonBenett\CQRS\Command\DirectCommandBus
 */
class DirectCommandBusTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::handle
     */
    public function testHandle(): void
    {
        $command = new stdClass();

        $handlers = [
            $relevantHandler = $this->createMock(CommandHandlerInterface::class),
        ];

        $response = $this->createMock(CommandResponseInterface::class);

        $relevantHandler->expects(self::once())
            ->method('listenTo')
            ->willReturn(get_class($command));

        $relevantHandler->expects(self::once())
            ->method('handle')
            ->with($command)
            ->willReturn($response);

        $sut = new DirectCommandBus(...$handlers);

        self::assertSame($response, $sut->dispatch($command));
    }

    /**
     * @covers ::__construct
     * @covers ::handle
     */
    public function testHandleFailure(): void
    {
        $command = new stdClass();

        $handlers = [
            $irrelevantHandler = $this->createMock(CommandHandlerInterface::class),
        ];

        $irrelevantHandler->expects(self::once())
            ->method('listenTo')
            ->willReturn('whatever');

        $irrelevantHandler->expects(self::never())
            ->method('handle');

        $this->expectException(CommandHandlerNotFoundException::class);

        $sut = new DirectCommandBus(...$handlers);
        $sut->dispatch($command);
    }
}