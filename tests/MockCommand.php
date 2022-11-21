<?php

declare(strict_types=1);

namespace PhpStandard\CommandBus\Tests;

/** @package PhpStandard\CommandBus\Tests */
class MockCommand
{
    public string $id;

    /**
     * @param string $id 
     * @return void 
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
