<?php

declare(strict_types=1);

namespace PhpStandard\CommandBus\Tests;

use PhpStandard\CommandBus\Exceptions\CommandNotDispatchedException;
use PhpStandard\CommandBus\Mapper;
use PHPUnit\Framework\TestCase;
use stdClass;

/** @package PhpStandard\CommandBus\Tests */
class MapperTest extends TestCase
{
    private Mapper $mapper;

    /** @inheritDoc  */
    protected function setUp(): void
    {
        $container = new MockContainer();
        $this->mapper = new Mapper($container);
    }

    /** @test */
    public function canMapHandlerByFQCN()
    {
        $this->mapper->map(
            MockCommand::class,
            MockEventHandler::class
        );

        $cmd = new MockCommand(uniqid());
        $handler = $this->mapper->getHandler($cmd);

        $this->assertInstanceOf(MockEventHandler::class, $handler);
    }

    /** @test */
    public function canMapHandlerByObject()
    {
        $handler = new MockEventHandler();

        $this->mapper->map(
            MockCommand::class,
            $handler
        );

        $cmd = new MockCommand(uniqid());
        $handler = $this->mapper->getHandler($cmd);

        $this->assertInstanceOf(MockEventHandler::class, $handler);
    }

    /** @test */
    public function canIdentifyCommandsNotDispatched()
    {
        $this->expectException(CommandNotDispatchedException::class);
        $this->mapper->getHandler(new stdClass());
    }
}
