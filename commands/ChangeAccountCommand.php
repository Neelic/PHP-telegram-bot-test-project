<?php

namespace commands;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;
use TelegramBot\Api\Types\Update;
use user\UserLogic;

class ChangeAccountCommand implements Command
{
    private BotApi $bot;
    const CHANGE_ACCOUNT_ANSWER = 'Left on the account: ';

    public function __construct(BotApi $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function execute(Update $update): void
    {
        $message = $update->getMessage();
        $newCheck = UserLogic::changeCheck($message->getChat()->getId(), intval($message->getText()));
        $this->bot->sendMessage($update->getMessage()->getChat()->getId(), self::CHANGE_ACCOUNT_ANSWER . $newCheck);
    }
}