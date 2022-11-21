<?php

declare(strict_types=1);

namespace PhpStandard\CommandBus\Tests;

use PhpStandard\CommandBus\Dispatcher;
use PhpStandard\CommandBus\Mapper;
use PHPUnit\Framework\TestCase;

/** @package PhpStandard\CommandBus\Tests */
class DispatcherTest extends TestCase
{
    private Dispatcher $dispatcher;

    /** @inheritDoc */
    protected function setUp(): void
    {
        $container = new MockContainer();

        $mapper = new Mapper($container);
        $mapper->map(MockCommand::class, MockEventHandler::class);

        $this->dispatcher = new Dispatcher($mapper);
    }

    /** @test */
    public function canDispatch(): void
    {
        $id = uniqid();
        $cmd = new MockCommand($id);

        $resp = $this->dispatcher->dispatch($cmd);
        $this->assertEquals($id, $resp);
    }
}
