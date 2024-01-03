<?php

namespace App\Repository;

use App\Entity\BusinessOwner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BusinessOwner>
 *
 * @method BusinessOwner|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessOwner|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessOwner[]    findAll()
 * @method BusinessOwner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessOwnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessOwner::class);
    }

//    /**
//     * @return BusinessOwner[] Returns an array of BusinessOwner objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BusinessOwner
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
