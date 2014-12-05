<?php

namespace Lzdv\InitCmsExtensionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use Networking\InitCmsBundle\Model\ContentInterface;
use Lzdv\InitCmsExtensionBundle\Entity\CardViewInterface;

use Networking\InitCmsBundle\Model\Media;

/**
 * CardView
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="card_view")
 * @ORM\Entity
 */
class CardView implements CardViewInterface
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
     * @var Card $media
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
     * @var string $mediaSide
     *
     * @ORM\Column(name="media_side", type="string", length=20)
     * @Sonata\FormMapper(name="mediaSide", type="choice", options={"label" = "form.label_media_side", "choices" = {"left" = "sinistra", "right" = "destra"}})
     */
    protected $mediaSide = 'left';

    /**
     * @var string $mediaPadding
     *
     * @ORM\Column(name="media_padding", type="boolean", nullable=false)
     * @Sonata\FormMapper(name="mediaPadding", type="choice", options={"label" = "form.label_media_padding", "choices" = {0 = "allargata", 1 = "ristretta"}})
     */
    protected $mediaPadding;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=true)
     * @Sonata\FormMapper(name="title")
     */
    protected $title = '';

    /**
     * @var string $link
     *
     * @ORM\Column(name="link", type="string", length=150, nullable=true)
     * @Sonata\FormMapper(name="link")
     */
    protected $link = '#';

    /**
     * @var string $target
     *
     * @ORM\Column(name="target", type="string", length=10)
     * @Sonata\FormMapper(name="target", type="choice", options={"label" = "form.label_media_side", "choices" = {"_self" = "stessa pagina", "_blank" = "nuova pagina"}})
     */
    protected $target = '_self';

    /**
     * @var string $backgroundColor
     *
     * @ORM\Column(name="background_color", type="string", length=20, nullable=true)
     * @Sonata\FormMapper(name="background_color")
     */
    protected $backgroundColor = '';

    /**
     * @var string $textColor
     *
     * @ORM\Column(name="text_color", type="string", length=20, nullable=true)
     * @Sonata\FormMapper(name="text_color")
     */
    protected $textColor = '';

    /**
     * @var string $text
     * @ORM\Column(name="text", type="text")
     * @Sonata\FormMapper(
     *      name="text",
     *      type="ckeditor",
     *      options={
     *          "label_render" = false,
     *          "horizontal_input_wrapper_class" = "col-md-12",
     *          "horizontal_label_offset_class" = "",
     *          "label" = false,
     *          "required"=false
     *      }
     * )
     */
    protected $text;

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
     * @param  \Networking\InitCmsBundle\Entity\Card $media
     * @return $this
     */
    public function setMedia($media)
    {
        $this->media= $media;

        return $this;
    }

    /**
     * @return \Networking\InitCmsBundle\Entity\Card
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param  string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title= $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param  string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text= $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
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
            throw new \InvalidArgumentException('Card type not valid');
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
     * @param $mediaSide
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setMediaSide($mediaSide)
    {
        if (!in_array($mediaSide, array('left', 'right'))) {
            throw new \InvalidArgumentException('Card side not valid');
        }
        $this->mediaSide = $mediaSide;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediaSide()
    {
        return $this->mediaSide;
    }

    /**
     * @param $mediaPadding
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setMediaPadding($mediaPadding)
    {
        $this->mediaPadding = $mediaPadding;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediaPadding()
    {
        return $this->mediaPadding;
    }

    /**
     * @param $link
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param $link
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setBackgroundColor($color)
    {
        $this->backgroundColor = $color;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param $link
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setTextColor($color)
    {
        $this->textColor = $color;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * @param $target
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setTarget($target)
    {
        if (!in_array($target, array('_blank', '_self'))) {
            throw new \InvalidArgumentException('Card target not valid');
        }
        $this->target = $target;

        return $this;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
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
            'cardView' => $this
        );
    }

    /**
     * @return array
     */
    public function getAdminContent()
    {
        return array(
            'content' => array('cardView' => $this),
            'template' => 'LzdvInitCmsExtensionBundle:CardAdmin:card_view_block.html.twig'
        );
    }

    /**
     * @return bool
     */
    public function hasMedia()
    {
        return true;
        //return $this->media instanceof Networking\InitCmsBundle\Entity\Card;
    }

    /**
     * @return array
     *
    public function getCardItems()
    {
        $mediaItems = $this->getCard() ? $this->getCard() : array();

        return $mediaItems;
    }

    /**
     * @return string
     */
    public function getContentTypeName()
    {
        return 'Card Viewer';
    }
}
