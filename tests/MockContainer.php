<?php

namespace PhpStandard\CommandBus\Tests;

use Psr\Container\ContainerInterface;

/** @package PhpStandard\CommandBus\Tests */
class MockContainer implements ContainerInterface
{
    /** @inheritDoc */
    public function get(string $id)
    {
        return new MockEventHandler();
    }

    /** @inheritDoc */
    public function has(string $id): bool
    {
        return true;
    }
}
