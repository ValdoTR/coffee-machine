<?php

namespace App\Utility;

final class Logger
{
    public static function logDebug(string $message, mixed $context = null): void
    {
        self::log('DEBUG', $message, $context);
    }
    
    public static function logInfo(string $message, mixed $context = null): void
    {
        self::log('INFO', $message, $context);
    }
    
    public static function logWarning(string $message, mixed $context = null): void
    {
        self::log('WARNING', $message, $context);
    }
    
    public static function logError(string $message, mixed $context = null): void
    {
        self::log('ERROR', $message, $context);
    }

    private static function log(string $level, string $message, mixed $context = null): void
    {
        $prefix = sprintf("[%s] %s | ", date('Y-m-d H:i:s'), strtoupper($level));
        error_log($prefix . $message);
        self::logContext($context);
    }
    
    private static function logContext(mixed $context = null): void
    {
        if ($context !== null) {
            error_log("> " . print_r($context, true));
        }
    }

    public static function echoFeedback(string $message): void
    {
        // Logs in bold text
        echo "\033[1m$message\033[0m\n";
    }
}
