<?php

namespace Lzdv\InitCmsProductBundle\Entity;

use Networking\InitCmsBundle\Model\ContentInterface;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

/**
 * Networking\CollectionBundle\Entity\CollectionViewInterface
 *
 */
interface CollectionViewInterface extends ContentInterface
{
    /**
     * @param  \Application\Sonata\ClassificationBundle\Entity\Collection $media
     * @return $this
     */
    public function setCollection($media);

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Collection
     */
    public function getCollection();

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
