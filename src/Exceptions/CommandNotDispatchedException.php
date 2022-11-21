<?php

namespace PhpStandard\CommandBus\Exceptions;

use Exception;
use Throwable;

/** @package Framework\CommandBus\Exceptions */
class CommandNotDispatchedException extends Exception
{
    /**
     * @param object $cmd
     * @param int $code
     * @param null|Throwable $previous
     * @return void
     */
    public function __construct(
        private object $cmd,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        $message = sprintf(
            'Command <%s> not dispatched',
            get_class($cmd)
        );

        parent::__construct($message, $code, $previous);
    }

    /** @return object  */
    public function getCommand(): object
    {
        return $this->cmd;
    }
}
