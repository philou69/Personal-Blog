<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{

    public function findOther($slug)
    {
        $queryBuilder = $this->createQueryBuilder('c');

        $queryBuilder->where('c.slug != :slug')
            ->setParameter('slug', $slug);

        return $queryBuilder;
    }
}