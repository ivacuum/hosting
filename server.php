<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($uri !== '/' and file_exists(__DIR__ . '/public' . $uri)) {
    if ($uri === '/assets/service-worker.js') {
        header('Content-Type: application/javascript');
        header('Service-Worker-Allowed: /');
        readfile(__DIR__ . '/public' . $uri);

        return true;
    }

    return false;
}

require_once __DIR__ . '/public/index.php';
