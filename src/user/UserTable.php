<?php

namespace src\user;

use src\db\Database;
use PDOException;

class UserTable
{
    public static function create(int $id): void
    {
        $connection = Database::beginTransaction();

        try {
            $query = $connection->prepare("INSERT INTO `users` (`id`) VALUES ($id)");
            if (!$query->execute()) {
                throw new PDOException('User cannot be created');
            }

            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
            throw $e;
        }
    }

    public static function changeCheck(int $id, float $account): void
    {
        $connection = Database::beginTransaction();

        try {
            $query = $connection->prepare("UPDATE `users` SET `account` = $account WHERE `id` = $id");
            if (!$query->execute()) {
                throw new PDOException('User cannot be changed');
            }

            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
            throw $e;
        }
    }

    public static function getById(int $id): array
    {
        $query = Database::prepare("SELECT * FROM `users` WHERE `id` = $id");

        if (!$query->execute()) {
            throw new PDOException('User cannot be found');
        }

        return $query->fetch();
    }
}