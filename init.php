<?php

require_once __DIR__ . '/vendor/autoload.php';
use TelegramBot\Api\BotApi;

$bot_token = getenv('TELEGRAM_TOKEN');

try {
    $bot = new BotApi($bot_token);
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}
