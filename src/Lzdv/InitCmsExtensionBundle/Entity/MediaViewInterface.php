<?php

namespace Lzdv\InitCmsExtensionBundle\Entity;

use Networking\InitCmsBundle\Model\ContentInterface;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

/**
 * Networking\MediaBundle\Entity\MediaViewInterface
 *
 */
interface MediaViewInterface extends ContentInterface
{
    /**
     * @param  \Networking\InitCmsBundle\Entity\Media $media
     * @return $this
     */
    public function setMedia($media);

    /**
     * @return \Networking\InitCmsBundle\Entity\Media
     */
    public function getMedia();

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

    /**
     * @param $mediaType
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setMediaType($mediaType);

    /**
     * @return string
     */
    public function getMediaType();

    /**
     * @return bool
     */
    public function hasMedia();

    /**
     * @return array
     *
    public function getMediaItems();
    */
}
