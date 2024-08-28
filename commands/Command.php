<?php

namespace commands;

use TelegramBot\Api\Types\Update;

interface Command
{
    public function execute(Update $update): void;
}