<?php

namespace Lzdv\InitCmsPostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use Networking\InitCmsBundle\Model\ContentInterface;
use Lzdv\InitCmsPostBundle\Entity\PostsFilterViewInterface;
use Networking\InitCmsBundle\Entity\DynamicLayoutBlockInterface;

use Doctrine\Common\Collections\ArrayCollection;
 
use Application\Sonata\ClassificationBundle\Entity\Tag;
use Application\Sonata\ClassificationBundle\Entity\Collection;

/**
 * PostsFilterView
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="posts_filter_view")
 * @ORM\Entity
 */
class PostsFilterView implements PostsFilterViewInterface, DynamicLayoutBlockInterface
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
     * @ORM\ManyToMany(targetEntity="Application\Sonata\ClassificationBundle\Entity\Collection")
     * @ORM\JoinTable(name="posts_filter_collections",
     *      joinColumns={@ORM\JoinColumn(name="posts_filter_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="collection_id", referencedColumnName="id")}
     *      )
     *
     * @Sonata\FormMapper(name="collections", options={"required" = false, "empty_data" = null, "label" = "form.label_collections","data_class"=null,"class"="Application\Sonata\ClassificationBundle\Entity\Collection"})
     **/
    private $collections;
    
    /**
     * @ORM\ManyToMany(targetEntity="Application\Sonata\ClassificationBundle\Entity\Tag")
     * @ORM\JoinTable(name="posts_filter_tags",
     *      joinColumns={@ORM\JoinColumn(name="posts_filter_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     *
     * @Sonata\FormMapper(name="tags", options={"required" = false, "empty_data" = null, "label" = "form.label_tags","data_class"=null,"class"="Application\Sonata\ClassificationBundle\Entity\Tag"})
     **/
    private $tags;

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
    
    public function __construct()
    {
        $this->collections = new ArrayCollection();
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
     * @param  \ArrayCollection
     * @return $this
     */
    public function setCollections(ArrayCollection $collections)
    {
        $this->collections = $collections;

        return $this;
    }

    /**
     * @return \ArrayCollection
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Collection
     */
    public function addCollection(Collection $collection)
    {
        return $this->collections[] = $collection;
    }

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Collection
     */
    public function removeCollection(Collection $collection)
    {
        return $this->collections->removeElement($collection);
    }
    
    /**
     * @param  \ArrayCollection
     * @return $this
     */
    public function setTags(ArrayCollection $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return \ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Tag
     */
    public function addTag(Tag $tag)
    {
        return $this->tags[] = $tag;
    }

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Tag
     */
    public function removeTag(Tag $tag)
    {
        return $this->tags->removeElement($tag);
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
            'tags' => $this->getTags(),
            'collections' => $this->getCollections(),
            'postsFilterView' => $this
        );
    }

    /**
     * @return array
     */
    public function getAdminContent()
    {
//        $this->collections->setCollections( $this->collections );
        return array(
            'content' => array('postsFilterView' => $this),
            'template' => 'LzdvInitCmsPostBundle:PostsFilterAdmin:posts_filter_view_block.html.twig'
        );
    }

    /**
     * @return string
     */
    public function getContentTypeName()
    {
        return 'Posts Filter Viewer';
    }
    
}
