<?php

namespace Lzdv\InitCmsExtensionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use Networking\InitCmsBundle\Model\ContentInterface;
use Lzdv\InitCmsExtensionBundle\Entity\MediaViewInterface;

use Networking\InitCmsBundle\Model\Media;

/**
 * MediaView
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="media_view")
 * @ORM\Entity
 */
class MediaView implements MediaViewInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Media $media
     *
     * @ORM\ManyToOne(targetEntity="Networking\InitCmsBundle\Entity\Media", cascade={"merge"})
     * @ORM\JoinColumn( name="media_id", onDelete="CASCADE" )
     *
     * @Sonata\FormMapper(name="media", type="entity", options={"label" = "form.label_media","data_class"=null,"class"="Networking\InitCmsBundle\Entity\Media"})
     */
    protected $media;

    /**
     * @var string $mediaType
     *
     * @ORM\Column(name="media_type", type="string", length=50)
     * @Sonata\FormMapper(name="mediaType", type="choice", options={"label" = "form.label_media_type", "choices" = {"image" = "image", "video" = "video"}})
     */
    protected $mediaType = 'image';

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     *
     */
    public function __clone()
    {
        $this->id = null;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {

        $this->createdAt = $this->updatedAt = new \DateTime("now");
    }

    /**
     * Hook on pre-update operations
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  \Networking\InitCmsBundle\Entity\Media $media
     * @return $this
     */
    public function setMedia($media)
    {
        $this->media= $media;

        return $this;
    }

    /**
     * @return \Networking\InitCmsBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set createdAt
     *
     * @return $this
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param $mediaType
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setMediaType($mediaType)
    {
        if (!in_array($mediaType, array('image', 'video'))) {
            throw new \InvalidArgumentException('Media type not valid');
        }
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }


    /**
     * @param array $params
     * @return array
     */
    public function getTemplateOptions($params = array())
    {
        return array(
            'mediaItems' => $this->getMedia(),
            'media' => $this->getMedia(),
            'mediaView' => $this
        );
    }

    /**
     * @return array
     */
    public function getAdminContent()
    {
        return array(
            'content' => array('mediaView' => $this),
            'template' => 'LzdvInitCmsExtensionBundle:MediaAdmin:media_view_block.html.twig'
        );
    }

    /**
     * @return bool
     */
    public function hasMedia()
    {
        return true;
        //return $this->media instanceof Networking\InitCmsBundle\Entity\Media;
    }

    /**
     * @return array
     *
    public function getMediaItems()
    {
        $mediaItems = $this->getMedia() ? $this->getMedia() : array();

        return $mediaItems;
    }

    /**
     * @return string
     */
    public function getContentTypeName()
    {
        return 'Media Viewer';
    }
}
