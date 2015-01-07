<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\ProductBundle\Entity;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\UnexpectedResultException;

use Knp\Component\Pager\Paginator;
use Sonata\ClassificationBundle\Model\CategoryInterface;
use Sonata\Component\Product\ProductInterface;
use Sonata\Component\Product\ProductManagerInterface;
use  Sonata\ProductBundle\Entity\ProductManager as BaseProductManager;

use Networking\InitCmsBundle\Entity\DynamicLayoutBlockDataManagerInterface;

class ProductManager extends BaseProductManager implements ProductManagerInterface, DynamicLayoutBlockDataManagerInterface
{
    /**
     * Retrieve an active product from its id and its slug
     *
     * @param int    $id
     * @param string $slug
     *
     * @return ProductInterface|null
     */
    public function genericFind($params=array())
    {
        $colls = $params['request']->query->get('collection');
        $cats = $params['request']->query->getDigits('cat');
        $tags = $params['request']->query->getDigits('tag');

        $k = 0;
        
        $queryBuilder = $this->getRepository()->createQueryBuilder('p')
            ->leftJoin('p.image', 'i')
            ->leftJoin('p.gallery', 'g');

        if (!empty($colls))
        {
            $queryBuilder
                ->leftJoin('p.productCollections', 'pl')
                ->leftJoin('pl.collection', 'cl')
            ;
            $expr = $queryBuilder->expr()->orX();
            
            $expr->add('cl.slug = :collection_'.$k);
            $queryBuilder->setParameter('collection_'.$k, $colls);
            
            $queryBuilder->andWhere($expr);
        }

        if (!empty($cats) && is_array($cats))
        {
            foreach($cats as $j => $cat)
            {
                $queryBuilder
                    ->leftJoin('p.productCategories', 'pc'.$j);
                $expr = $queryBuilder->expr()->orX();
                foreach ($cat as $subcat) {
                    $expr->add('pc'.$j.'.category = :categoryId_'.$k);
                    $queryBuilder->setParameter('categoryId_'.$k, $subcat);
                    ++$k;
                }
                $queryBuilder->andWhere($expr);
            }
        }
        
//        echo $queryBuilder->getDQL();
//        die;

        return $queryBuilder
            ->getQuery()
            ->execute();
/*        
        return $this->getRepository()
            ->findAll();
//            ->findOneBy(array(
//                'id' => $id,
//                'slug' => $slug,
//                'enabled' => true
//            ));
*/
    }

}
