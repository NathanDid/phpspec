<?php

namespace App\Domain\Marble;

use App\Domain\Model\User;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;

class Competition
{
    const POINTS_RED_MARBLE = 3;
    const POINTS_BLUE_MARBLE = 1;

    function getUserPoints(User $user): int
    {
        return $user->getBlueMarbles() * self::POINTS_BLUE_MARBLE +
            $user->getRedMarbles() * self::POINTS_RED_MARBLE
        ;
    }

    function getWinner($users, LoggerInterface $logger = null): User
    {
        $winner = null;

        foreach ($users as $user) {
            if ($winner === null) {
                $winner = $user;
                continue;
            }

            $userPoints = $this->getUserPoints($user);

            if ($userPoints > $this->getUserPoints($winner)) {
                $winner = $user;
            }
        }

        foreach ($users as $user) {
            if ($this->getUserPoints($user) === $this->getUserPoints($winner)
                && $winner !== $user
            ) {
                if ($logger) {
                    $logger->warning('Multiple winner detected !!');
                }

                throw new \Exception('Multiple winner detected');
            }
        }

        return $winner;
    }
}