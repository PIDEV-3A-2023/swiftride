<?php 

namespace App\Repository;

use App\Entity\Garage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Classroom>
 *
 * @method Garage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Garage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Garage[]    findAll()
 * @method Garage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

 class GarageRepository extends ServiceEntityRepository 
 {

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry ,Garage::class);
    }


    public function save(Garage $entity , bool $flush =false):void
    {
        $this->getEntityManager()->persist($entity);
        if($flush){
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Garage $entity, bool $flush=false):void
    {
        $this->getEntityManager()->remove($entity);

        if($flush){
            $this->getEntityManager()->flush();
        }
    }

    public function getGarageWithMatricule($matricule){

        return $this->createQueryBuilder('g')
        ->where('g.matricule_garage LIKE :mat')
        ->setParameter('mat',$matricule)
        ->getQuery()
        ->getResult();
    }


 }