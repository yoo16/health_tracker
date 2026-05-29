<?php

namespace Lib;

use Throwable;

class App
{
    public static function boot(): void
    {
        self::defineBaseUrl();
        self::startSession();
        self::normalizeDatabaseConfig();
        self::redirectToSetupIfDatabaseUnavailable();
    }

    public static function baseUrl(): string
    {
        return BASE_URL;
    }

    private static function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            session_regenerate_id(true);
        }
    }

    private static function redirectToSetupIfDatabaseUnavailable(): void
    {
        if (self::isDatabaseSetupPage() || self::checkDatabaseConnection()) {
            return;
        }

        header('Location: ' . self::baseUrl() . 'create_database.php');
        exit;
    }

    private static function checkDatabaseConnection(): bool
    {
        try {
            Database::getInstance();
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    private static function isDatabaseSetupPage(): bool
    {
        return basename($_SERVER['SCRIPT_NAME'] ?? '') === 'create_database.php';
    }

    private static function defineBaseUrl(): void
    {
        if (defined('BASE_URL')) {
            return;
        }

        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
        $scriptFile = str_replace('\\', '/', realpath($_SERVER['SCRIPT_FILENAME'] ?? '') ?: '');
        $appRoot = str_replace('\\', '/', realpath(dirname(__DIR__)) ?: dirname(__DIR__));

        $relativeScriptDir = '';
        if ($scriptFile !== '' && str_starts_with($scriptFile, $appRoot)) {
            $relativeScriptPath = ltrim(substr($scriptFile, strlen($appRoot)), '/');
            $relativeScriptDir = trim(dirname($relativeScriptPath), '.');
        }

        $publicDir = trim(dirname($scriptName), '/');
        if ($relativeScriptDir !== '') {
            $relativeScriptDir = trim($relativeScriptDir, '/');
            if ($publicDir === $relativeScriptDir) {
                $publicDir = '';
            } else {
                $publicDir = preg_replace(
                    '#/' . preg_quote($relativeScriptDir, '#') . '$#',
                    '',
                    $publicDir
                );
            }
        }

        $baseUrl = $scheme . '://' . $host . '/';
        if ($publicDir !== '') {
            $baseUrl .= trim($publicDir, '/') . '/';
        }

        define('BASE_URL', $baseUrl);
    }

    private static function normalizeDatabaseConfig(): void
    {
        if (!defined('DB_DATABASE') && defined('DB_NAME')) {
            define('DB_DATABASE', DB_NAME);
        }
        if (!defined('DB_NAME') && defined('DB_DATABASE')) {
            define('DB_NAME', DB_DATABASE);
        }
        if (!defined('DB_USERNAME') && defined('DB_USER')) {
            define('DB_USERNAME', DB_USER);
        }
        if (!defined('DB_USER') && defined('DB_USERNAME')) {
            define('DB_USER', DB_USERNAME);
        }
        if (!defined('DB_PASSWORD') && defined('DB_PASS')) {
            define('DB_PASSWORD', DB_PASS);
        }
        if (!defined('DB_PASS') && defined('DB_PASSWORD')) {
            define('DB_PASS', DB_PASSWORD);
        }
        if (!defined('DB_CHARSET')) {
            define('DB_CHARSET', 'utf8mb4');
        }
    }
}
