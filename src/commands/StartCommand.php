<?php

namespace src\commands;

use PDOException;
use src\commands\Command;
use src\user\UserLogic;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class StartCommand implements Command
{
    private BotApi $bot;
    const START_COMMAND = '/start';
    const START_TEXT = 'Hi, I\'m your bot. Write any number to add/sub to your account.';

    public function __construct(BotApi $bot)
    {
        $this->bot = $bot;
    }

    public function execute(Update $update): void
    {
        try {
            UserLogic::create($update->getMessage()->getChat()->getId());
            $this->bot->sendMessage($update->getMessage()->getChat()->getId(), self::START_TEXT);
        } catch (PDOException $e) {
        }
    }
}