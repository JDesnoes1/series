<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Serie>
 *
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function save(Serie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Serie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

     public function findBestSeries(){
        //En DQL

         /*$entityManager = $this->getEntityManager();

         $dql = "SELECT s FROM App\Entity\Serie AS s 
                    WHERE s.vote > 8
                    AND s.popularity > 200
                    ORDER BY s.popularity DESC";

         $query = $entityManager->createQuery($dql);
         $query->setMaxResults(50);
         return $query->getResult();*/

         $qb = $this->createQueryBuilder('s');
         $qb->andWhere('s.vote > 8')
            ->andWhere('s.popularity > 200')
            ->orderBy('s.popularity', 'DESC');

         $query = $qb->getQuery();

         $query->setMaxResults(50);
         return $query->getResult();



     }
}
