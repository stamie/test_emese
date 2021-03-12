<?php

namespace App\Repository;

use App\Entity\Modell;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Modell|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modell|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modell[]    findAll()
 * @method Modell[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModellRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modell::class);
    }

    // /**
    //  * @return Modell[] Returns an array of Modell objects
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
    public function findOneBySomeField($value): ?Modell
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
