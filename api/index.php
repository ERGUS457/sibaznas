<?php

// Setup storage directories in /tmp for Vercel serverless read-only filesystem
$tmpStorage = '/tmp/storage';
$dirs = [
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    $tmpStorage . '/app/public',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Point Laravel compiled views and caches to writable /tmp
putenv("VIEW_COMPILED_PATH={$tmpStorage}/framework/views");
putenv("APP_CONFIG_CACHE={$tmpStorage}/config.php");
putenv("APP_EVENTS_CACHE={$tmpStorage}/events.php");
putenv("APP_PACKAGES_CACHE={$tmpStorage}/packages.php");
putenv("APP_ROUTES_CACHE={$tmpStorage}/routes.php");
putenv("APP_SERVICES_CACHE={$tmpStorage}/services.php");

// Forward request to Laravel public/index.php
require __DIR__ . '/../public/index.php';
