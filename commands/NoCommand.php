<?php

namespace commands;

use commands\Command;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;
use TelegramBot\Api\Types\Update;

class NoCommand implements Command
{
    private BotApi $bot;
    const NO_COMMAND = 'Not supported command.';

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
        $this->bot->sendMessage($update->getMessage()->getChat()->getId(), self::NO_COMMAND);
    }
}