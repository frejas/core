<?php

namespace Frejas\Core\Contracts;

use Exception;
use Psr\Http\Message\ResponseInterface;

interface ExceptionHandlerInterface {
    public function handle(Exception $ex): ResponseInterface;
}
