<?php
/**
 * WOLFIE Configuration
 * 
 * Shared configuration for WOLFIE MD viewer and definitions viewer
 */

// Path to MD files directory (use proper directory separator for Windows/Linux)
define('WOLFIE_MD_FILES_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'md_example_files' . DIRECTORY_SEPARATOR);

// Available channels (auto-detect from directory structure)
function getWolfieChannels() {
    $channels = [];
    
    if (!is_dir(WOLFIE_MD_FILES_PATH)) {
        return $channels;
    }
    
    $dirs = scandir(WOLFIE_MD_FILES_PATH);
    foreach ($dirs as $dir) {
        if (preg_match('/^(\d+)_wolfie$/', $dir, $matches)) {
            $channels[] = (int)$matches[1];
        }
    }
    
    sort($channels);
    return $channels;
}

