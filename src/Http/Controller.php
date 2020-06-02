<?php

namespace Frejas\Core\Http;

use GuzzleHttp\Psr7\Response;

abstract class Controller {

    public function json(int $status, $data) {
        return new Response($status, [
            'Content-Type' => 'application/json'

        ], json_encode($data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR, 512));
    }

}
