<?php
declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Organisator;
use Doctrine\ORM\EntityRepository;

final class OrganisatorRepository extends EntityRepository
{

    public function get($id)
    {
        $organisator = $this->getEntityManager()->getRepository(Organisator::class)->find($id);
        return $organisator;
    }

}