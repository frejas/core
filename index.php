<?php

use Frejas\Core\App;
use GuzzleHttp\Psr7\ServerRequest;

define('BASE_DIR', __DIR__);

require_once __DIR__ . '/vendor/autoload.php';

$application = new App();
$result = $application->handle(ServerRequest::fromGlobals());

foreach ($result->getHeaders() as $name => $header) {
    foreach ($header as $value) {
        header(sprintf('%s: %s', $name, $value), true);
    }
}
http_response_code($result->getStatusCode());
die($result->getBody());
