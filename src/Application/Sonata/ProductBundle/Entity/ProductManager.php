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
        $cats = $params['request']->query->getDigits('cat');
        $colls = $params['request']->query->getDigits('col');
        $tags = $params['request']->query->getDigits('tag');

        $k = 0;
//die(var_dump($colls));
        
        $queryBuilder = $this->getRepository()->createQueryBuilder('p')
            ->leftJoin('p.image', 'i')
            ->leftJoin('p.gallery', 'g');

        if (!empty($colls) && is_array($colls) && !empty($colls[0]))
        {
            $queryBuilder
                ->leftJoin('p.productCollections', 'pl');
            $expr = $queryBuilder->expr()->orX();
            foreach ($colls as $col) {
                $expr->add('pl.collection = :collectionId_'.$k);
                $queryBuilder->setParameter('collectionId_'.$k, $col);
                ++$k;
            }
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
