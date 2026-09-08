<?php

// Setup storage directories in /tmp for Vercel serverless read-only filesystem
$tmpStorage = '/tmp/storage';
$dirs = [
    '/tmp/views',
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    $tmpStorage . '/app/public',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Point Laravel paths and set environment flags
putenv("VIEW_COMPILED_PATH={$tmpStorage}/framework/views");
putenv("VERCEL=1");
$_ENV['VERCEL'] = '1';
$_SERVER['VERCEL'] = '1';

// Forward request to Laravel public/index.php
require __DIR__ . '/../public/index.php';
