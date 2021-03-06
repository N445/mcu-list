<?php

namespace AppBundle\Repository;

/**
 * VideoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VideoRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     *
     * @param $id
     * @return mixed
     */
    public function getMaxOrderValue()
    {
        $qb = $this->createQueryBuilder('v')
                   ->addSelect('v')
                   ->orderBy('v.ordre', 'DESC')
                   ->setMaxResults(1)
                   ->getQuery()
        ;
        return $qb->getOneOrNullResult();
    }

    public function getVideoByOrdreAdmin()
    {
        $qb = $this->createQueryBuilder('v')
                   ->orderBy('v.ordre', 'ASC')
                   ->getQuery()
        ;
        return $qb->execute();
    }
    public function getVideoByOrdre()
    {
        $qb = $this->createQueryBuilder('v')
                   ->where('v.active = 1')
                   ->orderBy('v.ordre', 'ASC')
                   ->getQuery()
        ;
        return $qb->execute();
    }

}
