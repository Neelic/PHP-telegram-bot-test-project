<?php

namespace user;

use db\Database;
use PDOException;

class UserTable
{
    public static function create(int $id): void {
        $query = Database::prepare("INSERT INTO `users` (`id`) VALUES ($id)");

        if (!$query->execute()) {
            throw new PDOException('User cannot be created');
        }
    }

    public static function changeCheck(int $id, float $account): void
    {
        $query = Database::prepare("UPDATE `users` SET `account` = $account WHERE `id` = $id");

        if (!$query->execute()) {
            throw new PDOException('User cannot be changed');
        }
    }

    public static function getById(int $id): array {
        $query = Database::prepare("SELECT * FROM `users` WHERE `id` = $id");

        if (!$query->execute()) {
            throw new PDOException('User cannot be found');
        }

        return $query->fetch();
    }
}