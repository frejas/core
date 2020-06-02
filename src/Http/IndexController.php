<?php

namespace Frejas\Core\Http;

use Psr\Http\Message\ResponseInterface;

class IndexController extends Controller {
    public function getIndex(): ResponseInterface {
        return $this->json(200, ["status" => 'Is Okay!']);
    }
}
