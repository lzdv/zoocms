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

        $queryBuilder = $this->getRepository()->createQueryBuilder('p')
            ->leftJoin('p.image', 'i')
            ->leftJoin('p.gallery', 'g');

        if (!empty($cats) && is_array($cats))
        {
            $queryBuilder
                ->leftJoin('p.productCategories', 'pc');
            $expr = $queryBuilder->expr()->orX();
            foreach ($cats as $k => $cat) {
                $expr->add('pc.category = :categoryId_'.$k);
                $queryBuilder->setParameter('categoryId_'.$k, $cat);
            }
            $queryBuilder->andWhere($expr);
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
