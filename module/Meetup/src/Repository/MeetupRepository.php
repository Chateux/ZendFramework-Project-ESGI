<?php
declare(strict_types=1);

namespace Meetup\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;
use Meetup\Entity\Organisator;

final class MeetupRepository extends EntityRepository
{
    public function add($meetup): void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function edit($meetup): void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function delete($meetup): void
    {
        $this->getEntityManager()->remove($meetup);
        $this->getEntityManager()->flush();
    }

    public function get($id)
    {

        $meetup = $this->getEntityManager()->getRepository(Meetup::class)->find($id);
        return $meetup;

    }

    public function getByEntity($id)
    {

        $meetup = $this->getEntityManager()->createQueryBuilder();
        $meetup->select('m', 'o')
            ->from(Meetup::class, 'm')
            ->leftJoin(
                Organisator::class,
                'o',
                Join::WITH,
                'm.idMeetup = o.id'
            )
            ->where('m.id = :id')
            ->setParameter('id', $id);

        return $meetup->getQuery()->getResult();

    }

    public function createMeetup(string $title,string $description, \DateTime $startdate, \DateTime $enddate)
    {
        return new Meetup($title, $description, $startdate, $enddate);
    }
}