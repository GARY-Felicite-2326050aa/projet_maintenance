<?php

namespace App\Repository;

use App\Entity\Championnats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Repository pour l'entité Championnats.
 *
 * @extends ServiceEntityRepository<Championnats>
 */
class ChampionnatsRepository extends ServiceEntityRepository
{
    /**
     * ChampionnatsRepository constructor.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Championnats::class);
    }

    // Exemple de méthode personnalisée :
    // /**
    //  * @return Championnats[]
    //  */
    // public function findByExampleField($value): array
    // {
    //     return $this->createQueryBuilder('c')
    //         ->andWhere('c.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('c.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }
}
