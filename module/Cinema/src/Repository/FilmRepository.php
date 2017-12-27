<?php

declare(strict_types=1);

namespace Cinema\Repository;

use Cinema\Entity\Film;
use Doctrine\ORM\EntityRepository;

final class FilmRepository extends EntityRepository
{
    public function save(Film $film) : void
    {
        //Faire le update
        $this->getEntityManager()->persist($film);
        $this->getEntityManager()->flush($film);

    }

    public function delete(string $id)
    {
        $this->getEntityManager()->remove($this->find($id));
        $this->getEntityManager()->flush();

    }
}
