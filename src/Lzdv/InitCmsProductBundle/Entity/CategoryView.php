<?php

namespace Lzdv\InitCmsProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use Networking\InitCmsBundle\Model\ContentInterface;
use Lzdv\InitCmsProductBundle\Entity\CategoryViewInterface;
use Networking\InitCmsBundle\Entity\DynamicLayoutBlockInterface;

use Application\Sonata\ClassificationBundle\Entity\Category;

/**
 * CategoryView
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="category_view")
 * @ORM\Entity
 */
class CategoryView implements CategoryViewInterface, DynamicLayoutBlockInterface
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
     * @var Category $category
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\ClassificationBundle\Entity\Category", cascade={"merge"}, fetch="EAGER")
     * @ORM\JoinColumn( name="category_id", onDelete="CASCADE" )
     *
     * @Sonata\FormMapper(name="category", type="entity", options={"label" = "form.label_category","data_class"=null,"class"="Application\Sonata\ClassificationBundle\Entity\Category"})
     */
    protected $category;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=true)
     * @Sonata\FormMapper(name="title")
     */
    protected $title = '';

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
     * @param  \Application\Sonata\ClassificationBundle\Entity\Category $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category= $category;

        return $this;
    }

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
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
     * Get dynamic data
     *
     * @return \string
     */
    public function getDynamicDataManagerName()
    {
        return '';
    }
    
    /**
     * 
     */
    public function setDynamicData($data)
    {
    }
    
    /**
     * @param array $params
     * @return array
     */
    public function getTemplateOptions($params = array())
    {
        return array(
            'categories' => $this->getCategory()->getChildren(),
            'categoryView' => $this
        );
    }

    /**
     * @return array
     */
    public function getAdminContent()
    {
        $this->category->setChildren( $this->category->getChildren() );
        return array(
            'content' => array('categoryView' => $this),
            'template' => 'LzdvInitCmsProductBundle:CategoryAdmin:category_view_block.html.twig'
        );
    }

    /**
     * @return string
     */
    public function getContentTypeName()
    {
        return 'Category Viewer';
    }
    
}
