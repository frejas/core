<?php

namespace Frejas\Core\Http;

use Psr\Http\Message\ResponseInterface;

class IndexController extends Controller {
    public function getIndex(): ResponseInterface {
        return $this->json(200, ["v" => '0.0.1-alpha1', 'status' => 'Not ready for production!']);
    }
}
