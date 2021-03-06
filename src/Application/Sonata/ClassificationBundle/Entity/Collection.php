<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\ClassificationBundle\Entity;

use Sonata\ClassificationBundle\Entity\BaseCollection as BaseCollection;

/**
 * This file has been generated by the Sonata EasyExtends bundle ( http://sonata-project.org/bundles/easy-extends )
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class Collection extends BaseCollection
{
    /**
     * @var integer $id
     */
    protected $id;

    protected $collectionProducts;
    
    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Add a CollectionProduct to collection.
     *
     * @param CollectionProductInterface $productCollection
     */
    public function addCollectionProduct(CollectionProductInterface $productCollection)
    {
        $productCollection->setCollection($this);

        $this->collectionProducts->add($productCollection);
    }

    /**
     * Remove a CollectionProduct from collection.
     *
     * @param CollectionProductInterface $productCollection
     */
    public function removeCollectionProduct(CollectionProductInterface $productCollection)
    {
        if ($this->collectionProducts->contains($productCollection)) {
            $this->collectionProducts->removeElement($productCollection);
        }
    }

    /**
     * Get CollectionProducts collection.
     *
     * @return ArrayCollection
     */
    public function getCollectionProducts()
    {
        return $this->collectionProducts;
    }

    /**
     * Set CollectionProduct collection.
     *
     * @param ArrayCollection $productCollections
     */
    public function setCollectionProducts(ArrayCollection $productCollections)
    {
        $this->collectionProducts = $productCollections;
    }

    /**
     * Get Collections collection.
     *
     * @return ArrayCollection
     */
    public function getCollections()
    {
        $collections = new ArrayCollection();

        foreach ($this->collectionProducts as $productCollection) {
            if (!$collections->contains($productCollection)) {
                $collections->add($productCollection->getCollection());
            }
        }

        return $collections;
    }
}