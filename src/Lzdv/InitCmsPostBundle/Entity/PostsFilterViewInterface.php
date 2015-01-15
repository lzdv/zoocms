<?php

namespace Lzdv\InitCmsPostBundle\Entity;

use Networking\InitCmsBundle\Model\ContentInterface;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use Doctrine\Common\Collections\ArrayCollection;

use Application\Sonata\ClassificationBundle\Entity\Tag;
use Application\Sonata\ClassificationBundle\Entity\Collection;


/**
 * Networking\CategoryBundle\Entity\CategoryViewInterface
 *
 */
interface PostsFilterViewInterface extends ContentInterface
{
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
     * @param  \Application\Sonata\ClassificationBundle\Entity\Tag $media
     * @return $this
     */
    public function setTags(ArrayCollection $tags);

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Tag
     */
    public function getTags();

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Tag
     */
    public function addTag(Tag $tag);

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Tag
     */
    public function removeTag(Tag $tag);

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
