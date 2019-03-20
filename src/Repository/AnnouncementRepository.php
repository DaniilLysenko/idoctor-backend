<?php

namespace App\Repository;

use App\Entity\Announcement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Announcement::class);
    }

    public function getAnnouncements()
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.active = 1')
            ->getQuery()
            ->getResult();
    }
}
