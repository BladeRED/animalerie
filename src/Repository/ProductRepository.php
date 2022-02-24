<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByPagination($currentPage, $nbResults){

        return $this->createQueryBuilder('p')
            ->setMaxResults($nbResults)
            ->setFirstResult(($currentPage*$nbResults)-$nbResults)
            ->getQuery()->getResult();

    }

    public function search($filters){

        $query = $this->createQueryBuilder('p')->leftJoin('p.id_category', 'categ');

        if(!is_null($filters['searchBar'])){

        $query->where('p.name LIKE :name')
        ->orWhere('p.description LIKE :name')
            ->orWhere('categ.name LIKE :name')
            ->setParameter('name', '%'.$filters['searchBar'].'%');


        }

        if(!is_null($filters['Category'])){

            $query->andWhere('categ = :categ')->setParameter('categ', $filters['Category']);


        }

        if(!empty($filters['nbStars'])){

            $query->andWhere('p.nbStars IN (:array)')->setParameter('array', $filters['nbStars']);


        }

        if(!is_null($filters['prixMin'])){

            $query->andWhere('p.price > :prixMin')->setParameter('prixMin', $filters['prixMin']);


        }
        if(!is_null($filters['prixMax'])){

            $query->andWhere('p.price < :prixMax')->setParameter('prixMax', $filters['prixMax']);


        }


        return $query->getQuery()->getResult();

    }



    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
