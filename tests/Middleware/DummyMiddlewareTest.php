<?php

declare(strict_types=1);

namespace JasonBenett\CQRS\Tests\Middleware;

use JasonBenett\CQRS\Middleware\AbstractMiddleware;
use JasonBenett\CQRS\Middleware\BusMiddlewareInterface;
use JasonBenett\CQRS\Response\ResponseInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @coversDefaultClass \JasonBenett\CQRS\Middleware\AbstractMiddleware
 */
class DummyMiddlewareTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::dispatch
     */
    public function testDispatch(): void
    {
        $subject    = new stdClass();
        $middleware = $this->createMock(BusMiddlewareInterface::class);
        $response   = $this->createMock(ResponseInterface::class);

        $middleware->expects(self::once())
            ->method('dispatch')
            ->with($subject)
            ->willReturn($response);

        $sut = new DummyMiddleware($middleware);

        self::assertSame($response, $sut->dispatch($subject));
        self::assertTrue($sut->preDispatched);
        self::assertTrue($sut->postDispatched);
    }
}

class DummyMiddleware extends AbstractMiddleware
{
    public bool $preDispatched = false;

    public bool $postDispatched = false;

    public function preDispatch(object $subject): void
    {
        $this->preDispatched = true;
    }

    public function postDispatch(object $subject, ResponseInterface $response): void
    {
        $this->postDispatched = true;
    }
}