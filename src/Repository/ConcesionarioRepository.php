<?php

namespace App\Repository;

use App\Entity\Concesionario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Concesionario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Concesionario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Concesionario[]    findAll()
 * @method Concesionario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcesionarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Concesionario::class);
    }

    // /**
    //  * @return Concesionario[] Returns an array of Concesionario objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Concesionario
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
