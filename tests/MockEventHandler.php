<?php

declare(strict_types=1);

namespace PhpStandard\CommandBus\Tests;

/** @package PhpStandard\CommandBus\Tests */
class MockEventHandler
{
    /**
     * @param MockCommand $cmd 
     * @return string 
     */
    public function handle(MockCommand $cmd): string
    {
        return $cmd->id;
    }
}
