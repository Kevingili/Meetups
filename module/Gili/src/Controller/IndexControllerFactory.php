<?php

declare(strict_types=1);

namespace Gili\Controller;

use Gili\Entity\Meetup;
use Gili\Form\MeetupForm;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class IndexControllerFactory
{
    public function __invoke(ContainerInterface $container) : IndexController
    {
        $meetupRepository = $container->get(EntityManager::class)->getRepository(Meetup::class);
        $meetupForm = $container->get(MeetupForm::class);

        return new IndexController($meetupRepository, $meetupForm);
    }
}
