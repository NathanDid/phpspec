<?php

declare(strict_types=1);

namespace spec\App\Domain\Marble;

use App\Domain\Model\User;
use App\Domain\Marble\Competition;
use App\Repository\UserRepository;
use PhpSpec\ObjectBehavior;
use Psr\Log\LoggerInterface;

class CompetitionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Competition::class);
    }

    function it_calculates_user_points(
        User $userA,
        User $userB
    )
    {
        $userA->getBlueMarbles()->willReturn(4);
        $userA->getRedMarbles()->willReturn(3);

        $userB->getBlueMarbles()->willReturn(0);
        $userB->getRedMarbles()->willReturn(0);

        $this->getUserPoints($userA)->shouldReturn(13);
        $this->getUserPoints($userB)->shouldReturn(0);
    }

    public function it_calculates_winner(
        User $userA,
        User $userB,
        User $userC,
        User $userD,
        LoggerInterface $logger
    )
    {
        $userA->getBlueMarbles()->willReturn(4);
        $userA->getRedMarbles()->willReturn(3);

        $userB->getBlueMarbles()->willReturn(0);
        $userB->getRedMarbles()->willReturn(0);

        $userC->getBlueMarbles()->willReturn(99);
        $userC->getRedMarbles()->willReturn(99);

        $userD->getBlueMarbles()->willReturn(2);
        $userD->getRedMarbles()->willReturn(14);

        $logger->warning('Multiple winner detected !!')->shouldNotBeCalled();

        $this->getWinner([$userA, $userB, $userC, $userD], $logger)->shouldReturn($userC);
    }

    public function it_throw_exception_because_multiple_winners(
        User $userA,
        User $userB,
        User $userC,
        LoggerInterface $logger
    )
    {
        $userA->getBlueMarbles()->willReturn(4);
        $userA->getRedMarbles()->willReturn(3);

        $userB->getBlueMarbles()->willReturn(0);
        $userB->getRedMarbles()->willReturn(0);

        $userC->getBlueMarbles()->willReturn(4);
        $userC->getRedMarbles()->willReturn(3);

        $logger->warning('Multiple winner detected !!')->shouldBeCalled();

        $this->shouldThrow(\Exception::class)->during('getWinner', [
            [$userA, $userB, $userC], $logger
        ]);
    }
}