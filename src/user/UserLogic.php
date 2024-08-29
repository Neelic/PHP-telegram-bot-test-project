<?php

namespace src\user;

use InvalidArgumentException;

class UserLogic
{
    public static function create(int $id): array
    {
        UserTable::create($id);
        return ['id' => $id, 'account' => 0.0];
    }

    public static function changeCheck(int $id, float $account): float
    {
        $user = UserTable::getById($id);
        if (empty($user)) {
            $user = self::create($id);
        }

        $newCheck = $user['account'] + $account;
        if ($newCheck < 0.0) {
            throw new InvalidArgumentException('The user does not have enough funds');
        }

        UserTable::changeCheck($id, $newCheck);
        return $newCheck;
    }
}