<?php

namespace PhpStandard\CommandBus;

use PhpStandard\CommandBus\Exceptions\CommandNotDispatchedException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/** @package Framework\CommandBus */
class Mapper
{
    /** @var array<string,object|string> */
    private array $map = [];

    /**
     * @param ContainerInterface $container
     * @return void
     */
    public function __construct(
        private ContainerInterface $container
    ) {
    }

    /**
     * @param object $cmd
     * @return object
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws CommandNotDispatchedException
     */
    public function getHandler(object $cmd): object
    {
        foreach ($this->map as $command => $handler) {
            if ($cmd instanceof $command) {
                if (!is_object($handler)) {
                    $handler = $this->container->get($handler);
                    $this->map[$command] = $handler;
                }

                return $handler;
            }
        }

        throw new CommandNotDispatchedException($cmd);
    }

    /**
     * @param string $cmd
     * @param object|string $handler
     * @return Mapper
     */
    public function map(
        string $cmd,
        object|string $handler
    ): self {
        $this->map[$cmd] = $handler;
        return $this;
    }
}
