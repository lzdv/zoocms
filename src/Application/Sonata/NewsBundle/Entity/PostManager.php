<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\NewsBundle\Entity;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\UnexpectedResultException;

use Knp\Component\Pager\Paginator;
use Sonata\ClassificationBundle\Model\CategoryInterface;
//use Sonata\Component\Post\PostInterface;
//use Sonata\Component\Post\PostManagerInterface;
use Sonata\NewsBundle\Model\BlogInterface;
use Sonata\NewsBundle\Entity\PostManager as BasePostManager;

use Networking\InitCmsBundle\Entity\DynamicLayoutBlockDataManagerInterface;

class PostManager extends BasePostManager implements DynamicLayoutBlockDataManagerInterface
{

    /**
     * Retrieve an active post from its id and its slug
     *
     * @param int    $id
     * @param string $slug
     *
     * @return PostInterface|null
     */
    public function proxyFind($params=array())
    {
        return array();
    }
    

    /**
     * @param string        $slug
     * @param BlogInterface $blog
     *
     * @return PostInterface
     */
    public function findOneBySlug($slug, BlogInterface $blog)
    {
        try {
            $repository = $this->getRepository();

            $query = $repository->createQueryBuilder('p');

            $query->andWhere('p.slug = :slug');
            $query->setParameters(array('slug' => $slug));

            return $query->getQuery()->getSingleResult();

        } catch (NoResultException $e) {
            return null;
        }
    }
    /**
     * @param string $date  Date in format YYYY-MM-DD
     * @param string $step  Interval step: year|month|day
     * @param string $alias Table alias for the publicationDateStart column
     *
     * @return array
     */
    public function getPublicationDateQueryParts($date, $step, $alias = 'p')
    {
        return parent::getPublicationDateQueryParts($date, $step, $alias);
    }

}
