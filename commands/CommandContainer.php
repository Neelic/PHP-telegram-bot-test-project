<?php

namespace commands;

use commands\Command;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class CommandContainer
{
    private BotApi $bot;
    private NoCommand $noCommand;

    public function __construct(BotApi $bot)
    {
        $this->bot = $bot;
        $this->noCommand = new NoCommand($this->bot);
    }

    public function findCommand(string $commandIdentifier)
    {
        $commandIdentifier = trim($commandIdentifier);
        preg_match('/^-?[0-9]+$/u', $commandIdentifier, $number);
        if ($number) {
            return new ChangeAccountCommand($this->bot);
        } else {
            return $this->noCommand;
        }
    }
}