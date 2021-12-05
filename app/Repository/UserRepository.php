<?php

namespace App\Repository;


class UserRepository extends AbstractRepository
{

    protected string $table = 'users';

    public function getUserById(int $userId)
    {
        $row = $this->query->find($userId);

        if(!$row) {
            throw new \DomainException(sprintf('User not found: %s', $userId));
        }

        return $row;
    }
}
