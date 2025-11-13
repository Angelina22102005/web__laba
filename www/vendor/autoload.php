<?php
// Simple autoloader for testing
spl_autoload_register(function (\) {
    // Project-specific namespace prefix
    \ = 'App\\\\';
    
    // Base directory for the namespace prefix
    \ = __DIR__ . '/../';
    
    // Does the class use the namespace prefix?
    \ = strlen(\);
    if (strncmp(\, \, \) !== 0) {
        // No, move to the next registered autoloader
        return;
    }
    
    // Get the relative class name
    \ = substr(\, \);
    
    // Replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    \ = \ . str_replace('\\\\', '/', \) . '.php';
    
    // If the file exists, require it
    if (file_exists(\)) {
        require \;
    }
});

// Include Guzzle manually if needed
if (file_exists(__DIR__ . '/../guzzlehttp/guzzle/src/functions_include.php')) {
    require_once __DIR__ . '/../guzzlehttp/guzzle/src/functions_include.php';
}
