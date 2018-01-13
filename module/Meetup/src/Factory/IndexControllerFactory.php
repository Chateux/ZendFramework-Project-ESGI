<?php
declare(strict_types=1);

namespace Meetup\Factory;

use Meetup\Controller\IndexController;
use Meetup\Entity\Meetup;
use Meetup\Entity\Organisator;
use Meetup\Form\MeetupForm;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class IndexControllerFactory
{
    public function __invoke(ContainerInterface $container): IndexController
    {
        $meetupRepository = $container->get(EntityManager::class)->getRepository(Meetup::class);
        $organisatorRepository = $container->get(EntityManager::class)->getRepository(Organisator::class);
        $meetupForm = $container->get(MeetupForm::class);
        return new IndexController($meetupRepository, $organisatorRepository, $meetupForm);
    }
}