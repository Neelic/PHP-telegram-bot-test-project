<?php

namespace user;

use InvalidArgumentException;

class UserLogic
{
    public static function create(int $id): void
    {
        UserTable::create($id);
    }

    public static function changeCheck(int $id, float $account): float
    {
        $user = UserTable::getById($id);
        if ($user['account'] <= $account) {
            throw new InvalidArgumentException('The user does not have enough funds');
        }

        $newCheck = $user['account'] + $account;
        UserTable::changeCheck($id, $newCheck);
        return $newCheck;
    }
}