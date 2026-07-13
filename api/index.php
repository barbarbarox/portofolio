<?php
// Vercel Entrypoint

// 1. Force environment variables to prevent writing to read-only storage
putenv('APP_ENV=production');
putenv('APP_DEBUG=false');
putenv('CACHE_STORE=array');
putenv('SESSION_DRIVER=cookie');
putenv('QUEUE_CONNECTION=sync');
putenv('LOG_CHANNEL=stderr');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('APP_PACKAGES_CACHE=/tmp/storage/bootstrap/cache/packages.php');
putenv('APP_SERVICES_CACHE=/tmp/storage/bootstrap/cache/services.php');

$_ENV['CACHE_STORE'] = 'array';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['LOG_CHANNEL'] = 'stderr';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/storage/bootstrap/cache/packages.php';
$_ENV['APP_SERVICES_CACHE'] = '/tmp/storage/bootstrap/cache/services.php';

// 2. Create the temporary directories
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/bootstrap/cache',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// 3. Boot Laravel and catch any hidden startup exceptions
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Vercel Deployment Error</h1>";
    echo "<h2>Main Exception:</h2>";
    echo "<pre>" . htmlspecialchars((string) $e) . "</pre>";
    
    if ($e->getPrevious()) {
        echo "<h2>Previous (Original) Exception:</h2>";
        echo "<pre>" . htmlspecialchars((string) $e->getPrevious()) . "</pre>";
    }
}

