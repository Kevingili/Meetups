<?php

declare(strict_types=1);

namespace Gili\Repository;

use Gili\Entity\Meetup;
use Doctrine\ORM\EntityRepository;

final class MeetupRepository extends EntityRepository
{
    public function save(Meetup $meetup) : void
    {
        //Faire le update
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);

    }

    public function delete(string $id)
    {
        $this->getEntityManager()->remove($this->find($id));
        $this->getEntityManager()->flush();

    }
}
