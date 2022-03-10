<?php

namespace App\Repository;

use App\Entity\Hiscore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hiscore|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hiscore|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hiscore[]    findAll()
 * @method Hiscore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HiscoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hiscore::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Hiscore $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Hiscore $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Hiscore[] Returns an array of Hiscore objects
     */
    public function findAllOrderByUserEmail(): array
    {
        return $this->createQueryBuilder('h')
            ->leftJoin('h.user','u')
            ->andWhere('h.moderated = 1','h.deleted = 0')
            ->addOrderBy('u.email', 'ASC')
            ->addOrderBy('h.score', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Hiscore[] Returns an array of Hiscore objects
    //  */
    // public function findUniqueHiscores(): array
    // {
    //     // SELECT a.id, a.score
    //     // FROM hiscore a
    //     // INNER JOIN (
    //     //     SELECT user_id, MAX(score) max_score
    //     //     FROM hiscore
    //     //     WHERE moderated = 1
    //     //     AND deleted = 0
    //     //     GROUP BY user_id
    //     // ) b ON a.user_id = b.user_id AND a.score = b.max_score

    //     // SELECT a.*
    //     // FROM hiscore a
    //     // LEFT JOIN hiscore b ON a.user_id = b.user_id AND a.score < b.score
    //     // WHERE b.id IS NULL

    //     return $this->createQueryBuilder('a')
    //         ->select('a')
    //         ->leftJoin(
    //             'App\Entity\Hiscore',
    //             'b',
    //             'WITH',
    //             'a.user = b.user AND a.score < b.score'
    //         )
    //         ->andWhere('b.score IS NULL') // ,'a.moderated = 1','a.deleted = 0'
    //         ->orderBy('a.score','DESC')
    //         ->getQuery()
    //         ->getResult();
    // }

    /**
     * @return Hiscore[] Returns an array of Hiscore objects
     */
    public function findUsersHighestLegitScore($user = null): ?Hiscore
    {
        {
            return $this->createQueryBuilder('h')
                ->andWhere('h.moderated = 1','h.deleted = 0','h.user = :user')
                ->orderBy('h.score', 'DESC')
                ->setMaxResults(1)
                ->setParameter('user', $user)
                ->getQuery()
                ->getOneOrNullResult();
        }
    }

    // /**
    //  * @return Hiscore[] Returns an array of Hiscore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hiscore
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
