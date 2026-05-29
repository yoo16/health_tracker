<?php
// 環境設定を読み込む
require_once 'env.php';
// データベース接続を読み込む
require_once 'lib/Database.php';
// サイトタイトル
const SITE_TITLE = 'KENKO LOG';

// セッション開始
session_start();
session_regenerate_id(true);

normalizeDatabaseConfig();

// もしDB接続できない場合、create_database.php にリダイレクト
// create_database.php 自身では接続前に表示する必要があるため除外する。
if (!isDatabaseSetupPage() && !checkDatabaseConnection()) {
    header('Location: ' . getBasePath() . 'create_database.php');
    exit;
}


function checkDatabaseConnection(): bool
{
    try {
        \Lib\Database::getInstance();
        return true;
    } catch (Throwable $e) {
        return false;
    }
}

function isDatabaseSetupPage(): bool
{
    return basename($_SERVER['SCRIPT_NAME'] ?? '') === 'create_database.php';
}

function getBasePath(): string
{
    $scriptDir = trim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');

    return $scriptDir === '' ? './' : str_repeat('../', substr_count($scriptDir, '/') + 1);
}

function normalizeDatabaseConfig(): void
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
