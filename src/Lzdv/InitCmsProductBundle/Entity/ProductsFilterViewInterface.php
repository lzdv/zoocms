<?php

namespace Lzdv\InitCmsProductBundle\Entity;

use Networking\InitCmsBundle\Model\ContentInterface;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use Doctrine\Common\Collections\ArrayCollection;

use Application\Sonata\ClassificationBundle\Entity\Category;
use Application\Sonata\ClassificationBundle\Entity\Collection;


/**
 * Networking\CategoryBundle\Entity\CategoryViewInterface
 *
 */
interface ProductsFilterViewInterface extends ContentInterface
{
    /**
     * @param  \ArrayCollection $categories
     * @return $this
     */
    public function setCategories(ArrayCollection $categories);

    /**
     * @return \ArrayCollection
     */
    public function getCategories();

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Category
     */
    public function addCategory(Category $category);

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Category
     */
    public function removeCategory(Category $category);

    /**
     * @param  \Application\Sonata\ClassificationBundle\Entity\Collection $media
     * @return $this
     */
    public function setCollections(ArrayCollection $collections);

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Collection
     */
    public function getCollections();

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Collection
     */
    public function addCollection(Collection $collection);

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Collection
     */
    public function removeCollection(Collection $collection);

    /**
     * @param  string $media
     * @return $this
     */
    public function setText($text);

    /**
     * @return string
     */
    public function getText();

    /**
     * Set createdAt
     *
     * @return $this
     */
    public function setCreatedAt();

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

}
