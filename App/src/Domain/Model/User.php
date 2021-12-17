<?php

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $bluesMarbles = 1;

    /**
     * @ORM\Column(type="integer")
     */
    private $redMarbles = 1;

    public function __construct(string $name, int $bluesMarbles, int $redMarbles)
    {
        $this->name = $name;
        $this->bluesMarbles = $bluesMarbles;
        $this->redMarbles = $redMarbles;
    }

    public function getRedMarbles(): int
    {
        return $this->redMarbles;
    }

    public function getBlueMarbles(): int
    {
        return $this->bluesMarbles;
    }
}
