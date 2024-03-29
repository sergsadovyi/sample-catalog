<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    /**
     * Get category by alias
     *
     * @param $alias
     *
     * @return null|Category
     */
    public function getByAlias($alias)
    {
        $category = $this->findOneBy(['alias' => $alias]);

        return $category;
    }

    /**
     * Get all categories
     *
     * @return array  Category list
     */
    public function getAll()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c');
        $qb->from('AppBundle:Category', 'c');
        $qb->orderBy('c.title');

        $query = $qb->getQuery();
        $categories = $query->getResult();

        return $categories;
    }
}
