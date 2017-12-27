<?php

declare(strict_types=1);

namespace Cinema\Form;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class FilmFormFactory
{
    public function __invoke(ContainerInterface $container) : FilmForm
    {
        $entityManager = $container->get(EntityManager::class);

        return new FilmForm($entityManager);
    }
}