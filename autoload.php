<?php
// simple autoload function to load classes from the "classes" directory
spl_autoload_register(function ($className) {
    $file = __DIR__ . '/classes/' . $className . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});

// autoload from different directories
spl_autoload_register(function ($className) {
    $paths = [
        __DIR__ . '/classes/',
        __DIR__ . '/models/',
        __DIR__ . '/libs/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// autoloading classes from the "src" directory with namespace support
spl_autoload_register(function ($className) {
    // Convert namespace to file path
    // Core\Database -> src/Core/Database.php
    // Models\Product -> src/Models/Product.php
    
    $prefix = ''; // No prefix in this example
    $baseDir = __DIR__ . '/src/';
    
    // Remove prefix if exists
    if (strpos($className, $prefix) === 0) {
        $className = substr($className, strlen($prefix));
    }
    
    // Replace namespace separators with directory separators
    $file = $baseDir . str_replace('\\', '/', $className) . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});