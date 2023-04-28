<?php

namespace App\Repository;

use App\Entity\Annonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Accident>
 *
 * @method Accident|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accident|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accident[]    findAll()
 * @method Accident[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonces::class);
    }

    public function save(Annonces $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Annonces $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function countTotalAnnoncement(): int
    {
        $qb = $this->createQueryBuilder('a');
        
        $qb->select($qb->expr()->count('a.id'));
        
        return (int) $qb->getQuery()->getSingleScalarResult();
    }
    public function getCountannoncementByMonth()
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('MONTHNAME(a.dateannonce) AS monthname')
           ->addSelect('COUNT(a.id) AS counta')
           ->groupBy('monthname')
           ->orderBy('monthname');
        
        return $qb->getQuery()->getArrayResult();
    }
    public function getCountannoncementByYEAR()
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('YEAR(a.dateannonce) AS years')
           ->addSelect('COUNT(a.id) AS count')
           ->groupBy('years')
           ->orderBy('years');
        
        return $qb->getQuery()->getArrayResult();
    }

//    /**
//     * @return Accident[] Returns an array of Accident objects
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

//    public function findOneBySomeField($value): ?Accident
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
