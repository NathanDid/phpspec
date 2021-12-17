<?php

declare(strict_types=1);

namespace spec\App\Domain\Model;

use App\Domain\Model\User;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Nathan', 4, 3);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }
}