<?php

declare(strict_types=1);

namespace Gili\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Meetup
 *
 * Attention : Doctrine génère des classes proxy qui étendent les entités, celles-ci ne peuvent donc pas être finales !
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Gili\Repository\MeetupRepository")
 * @ORM\Table(name="meetups")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description = '';

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $date_begin;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $date_end;

    public function __construct(string $title, string $description = '', string $date_begin = '', string $date_end = '')
    {
        $this->id = Uuid::uuid4()->toString();
        $this->title = $title;
        $this->description = $description;
        $this->date_begin = $date_begin;
        $this->date_end = $date_end;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $title
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    public function getDateBegin() : string
    {
        return $this->date_begin;
    }

    public function setDateBegin(string $date_begin) : void
    {
        $this->date_begin = $date_begin;
    }

    public function getDateEnd() : string
    {
        return $this->date_end;
    }

    public function setDateEnd(string $date_end) : void
    {
        $this->date_end = $date_end;
    }
}
