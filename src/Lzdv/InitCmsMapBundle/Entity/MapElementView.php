<?php

namespace Lzdv\InitCmsMapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use Networking\InitCmsBundle\Model\ContentInterface;
use Lzdv\InitCmsMapBundle\Entity\MapElementViewInterface;

use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Type;

use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;

use Lzdv\InitCmsMapBundle\Entity\Collection;

/**
 * MapElementView
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="map_element_view")
 * @ORM\Entity
 */
class MapElementView implements MapElementViewInterface
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
     * var Collection $collection
     *
     * @ORM\ManyToOne(targetEntity="Lzdv\InitCmsMapBundle\Entity\Collection", inversedBy="elements", cascade={"merge"})
     * @ORM\JoinColumn( name="collection_id", referencedColumnName="id", onDelete="CASCADE" )
     * @Sonata\FormMapper(name="collection", type="entity", options={"label"="form.label_collection","data_class"=null,"class"="Lzdv\InitCmsMapBundle\Entity\Collection"})
     * 
     */
    protected $collection;
    
    /**
     * @var string $mediaType
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @Sonata\FormMapper(name="name")
     */
    protected $name;

    /**
     * @var string $mediaType
     *
     * @ORM\Column(name="payoff", type="string", length=50, nullable=true)
     * @Sonata\FormMapper(name="payoff")
     */
    protected $payoff;

    /**
     * @var string lat
     *
     * @ORM\Column(name="lat", type="float", length=50)
     */
    protected $lat;

    /**
     * @var string lng
     *
     * @ORM\Column(name="lng", type="float", length=50)
     */
    protected $lng;

    /**
     *
     * @var oh_google_maps $latlng
     * @Sonata\FormMapper(
     *      name="latlng",
     *      type="oh_google_maps",
     *      options={
     *          "label_render" = false,
     *          "label" = false,
     *          "required"=true
     *      }
     * )
     * @Type("Oh\GoogleMapFormTypeBundle\Form\Type\GoogleMapType")
     */
    protected $latlng = array();

    /**
     * @var string $text
     * @ORM\Column(name="text", type="text", nullable=true)
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
    
    
    public function __construct()
    {
    }
    
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
     * @param  \Networking\InitCmsBundle\Entity\MapElement $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name= $name;

        return $this;
    }

    /**
     * @return \Networking\InitCmsBundle\Entity\MapElement
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string $payoff
     * @return $this
     */
    public function setPayoff($payoff)
    {
        $this->payoff= $payoff;

        return $this;
    }

    /**
     * @return string
     */
    public function getPayoff()
    {
        return $this->payoff;
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
     * @param  float $lat
     * @return $this
     */
    public function setLat($lat)
    {
        $this->lat= $lat;

        return $this;
    }

    /**
     * @return \Networking\InitCmsBundle\Entity\MapElement
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param  float $lng
     * @return $this
     */
    public function setLng($lng)
    {
        $this->lng= $lng;

        return $this;
    }

    /**
     * @return \Networking\InitCmsBundle\Entity\MapElement
     */
    public function getLng()
    {
        return $this->lng;
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

    public function setLatLng($latlng)
    {
       $this
          ->setLat($latlng['lat'])
          ->setLng($latlng['lng']);
       return $this;
    }

    /**
    * @Assert\NotBlank()
    * @OhAssert\LatLng()
    */
    public function getLatLng()
    {
       return array('lat' => $this->lat,'lng' => $this->lng);
    }
    
    /**
     * @param  \
     * @return $this
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return \
     */
    public function getCollection()
    {
        return $this->collection;
    }
    
    /**
     * @param array $params
     * @return array
     */
    public function getTemplateOptions($params = array())
    {
        if (isset($params['mapElementView']))
            unset($params['mapElementView']);
        
        return array_merge(
            array(
                'mapElementView' => $this,
            ),
            $params
        );
    }

    /**
     * @return array
     */
    public function getAdminContent()
    {
        return array(
            'content' => array('mapElementView' => $this),
            'template' => 'LzdvInitCmsMapBundle:MapElementAdmin:map_element_view_block.html.twig'
        );
    }

    /**
     * @return bool
     */
    public function hasMedia()
    {
        return true;
        //return $this->media instanceof Networking\InitCmsBundle\Entity\MapElement;
    }

    /**
     * @return array
     *
    public function getMapElementItems()
    {
        $mediaItems = $this->getMapElement() ? $this->getMapElement() : array();

        return $mediaItems;
    }

    /**
     * @return string
     */
    public function getContentTypeName()
    {
        return 'MapElement Viewer';
    }
}
