<?php

namespace src\commands;

use TelegramBot\Api\BotApi;

class CommandContainer
{
    private BotApi $bot;
    private NoCommand $noCommand;
    private array $commands = [];

    public function __construct(BotApi $bot)
    {
        $this->bot = $bot;
        $this->noCommand = new NoCommand($this->bot);

        $this->commands = [
            ChangeAccountCommand::CHANGE_COMMAND => new ChangeAccountCommand($this->bot),
        ];
    }

    public function findCommand(string $commandIdentifier): Command
    {
        $commandIdentifier = trim($commandIdentifier);
        preg_match('/^-?[0-9]+(|(.|,)[0-9]+)$/u', $commandIdentifier, $number);
        if ($number) {
            return $this->commands[ChangeAccountCommand::CHANGE_COMMAND];
        } else {
            return $this->noCommand;
        }
    }
}