<?php

namespace App\Repository;

use App\Entity\DietTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DietTypes>
 *
 * @method DietTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method DietTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method DietTypes[]    findAll()
 * @method DietTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DietTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DietTypes::class);
    }

//    /**
//     * @return DietTypes[] Returns an array of DietTypes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DietTypes
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
