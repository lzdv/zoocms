<?php

namespace Lzdv\InitCmsProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use JMS\Serializer\Annotation\Type;

use Networking\InitCmsBundle\Model\ContentInterface;
use Lzdv\InitCmsProductBundle\Entity\ProductDetailsViewInterface;
use Networking\InitCmsBundle\Entity\DynamicLayoutBlockInterface;

use Application\Sonata\ClassificationBundle\Entity\ProductDetails;

/**
 * ProductDetailsView
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="product_details_view")
 * @ORM\Entity
 */
class ProductDetailsView implements ProductDetailsViewInterface, DynamicLayoutBlockInterface
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
     * @var ProductDetails $product
     * @Type("Application\Sonata\ProductBundle\Entity\Wine")
     */
    private $product;
    
    /**
     * @var boolean $dynamic
     *
     * @ORM\Column(name="dynamic", type="boolean", options={"default"=0})
     * @Sonata\FormMapper(
     *      name="dynamic",
     *      type="choice",
     *      options={"label" = "form.label_media_type", "choices" = {"0" = "statico", "1" = "dinamico"}}
     * )
     */
    protected $dynamic;
    
    protected $em;
    
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
     * Get dynamic
     *
     * @param boolean $isDynamic
     * @return $this
     */
    public function setDynamic($isDynamic)
    {
        $this->dynamic = ($isDynamic==true);
    }
    
    /**
     * Get dynamic
     *
     * @return \boolean
     */
    public function getDynamic()
    {
        return $this->dynamic;
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

    public function getProduct() 
    {
        //die(get_class($this->productsManager));
        // get the block view class
        return $this->product;
    }
    
    public function setProduct() 
    {
        return;
    }
    
    /**
     * 
     */
    public function getDynamicDataManagerName()
    {
        return 'sonata.initcms.product.wine.manager';
    }
    
    /**
     * 
     */
    public function setDynamicData($data)
    {
        //die(var_dump(array_keys($data)));
        $this->product = $data;
    }
    
    /**
     * @param array $params
     * @return array
     */
    public function getTemplateOptions($params = array())
    {
        return array(
            'productDetailsView' => $this
        );
    }

    /**
     * @return array
     */
    public function getAdminContent()
    {
        return array(
            'content' => array('productDetailsView' => $this),
            'template' => 'LzdvInitCmsProductBundle:ProductDetailsAdmin:product_details_view_block.html.twig'
        );
    }

    /**
     * @return string
     */
    public function getContentTypeName()
    {
        return 'ProductDetails Viewer';
    }
    
}
