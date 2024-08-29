<?php

require_once __DIR__ . '/../vendor/autoload.php';

use src\commands\CommandContainer;
use TelegramBot\Api\BotApi;

$bot_token = getenv('TELEGRAM_TOKEN');
$offset = 0;
$timeout = 0;

try {
    $bot = new BotApi($bot_token);
    $commandContainer = new CommandContainer($bot);
    while (true) {
        $updates = $bot->getUpdates($offset, timeout: $timeout);
        foreach ($updates as $update) {
            $offset = $update->getUpdateId() + 1;
            $commandContainer->findCommand($update->getMessage()->getText())->execute($update);
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
