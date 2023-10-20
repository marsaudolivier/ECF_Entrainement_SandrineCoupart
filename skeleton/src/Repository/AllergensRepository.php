<?php

namespace App\Repository;

use App\Entity\Allergens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Allergens>
 *
 * @method Allergens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Allergens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Allergens[]    findAll()
 * @method Allergens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllergensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Allergens::class);
    }

//    /**
//     * @return Allergens[] Returns an array of Allergens objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Allergens
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
