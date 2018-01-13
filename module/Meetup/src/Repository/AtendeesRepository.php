<?php
declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Atendees;
use Doctrine\ORM\EntityRepository;

final class AtendeesRepository extends EntityRepository
{

    public function get($id)
    {
        $atendees = $this->getEntityManager()->getRepository(Atendees::class)->find($id);
        return $atendees;
    }

}