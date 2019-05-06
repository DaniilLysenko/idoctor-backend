<?php

namespace App\Repository;

use App\Entity\MedicalCardRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MedicalCardRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalCardRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalCardRecord[]    findAll()
 * @method MedicalCardRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalCardRecordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MedicalCardRecord::class);
    }

    // /**
    //  * @return MedicalCardRecord[] Returns an array of MedicalCardRecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MedicalCardRecord
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
