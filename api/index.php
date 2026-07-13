<?php

// Vercel Entrypoint

// Create necessary temp directories for Laravel
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app/public',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Override storage path via env before bootstrapping
$_ENV['APP_STORAGE'] = '/tmp/storage';

require __DIR__ . '/../public/index.php';
