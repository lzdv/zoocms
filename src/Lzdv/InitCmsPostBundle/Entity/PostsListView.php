<?php

namespace Lzdv\InitCmsPostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use JMS\Serializer\Annotation\Type;

use Networking\InitCmsBundle\Model\ContentInterface;
use Lzdv\InitCmsPostBundle\Entity\PostsListViewInterface;
use Networking\InitCmsBundle\Entity\DynamicLayoutBlockInterface;

use Application\Sonata\ClassificationBundle\Entity\PostsList;

/**
 * PostsListView
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="posts_list_view")
 * @ORM\Entity
 */
class PostsListView implements PostsListViewInterface, DynamicLayoutBlockInterface
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
     * @var PostsList $new
     * @Type("array<Application\Sonata\PostBundle\Entity\Wine>")
     */
    private $posts;    
    
    /**
     * @var PostsList $tag
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\ClassificationBundle\Entity\Tag", cascade={"merge"}, fetch="EAGER")
     * @ORM\JoinColumn( name="tag_id", onDelete="CASCADE", nullable=true )
     *
     * @Sonata\FormMapper(name="tag", type="entity", options={"required" = false, "empty_data" = null, "label" = "form.label_tag","data_class"=null,"class"="Application\Sonata\ClassificationBundle\Entity\Tag"})
     */
    protected $tag;

    /**
     * @var PostsList $collection
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\ClassificationBundle\Entity\Collection", cascade={"merge"}, fetch="EAGER")
     * @ORM\JoinColumn( name="collection_id", onDelete="CASCADE", nullable=true )
     *
     * @Sonata\FormMapper(name="collection", type="entity", options={"required" = false, "empty_data" = null, "label" = "form.label_collection","data_class"=null,"class"="Application\Sonata\ClassificationBundle\Entity\Collection"})
     */
    protected $collection;

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
     * @param  \Application\Sonata\ClassificationBundle\Entity\Tag $tag
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tag= $tag;

        return $this;
    }

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param  \Application\Sonata\ClassificationBundle\Entity\Collection $collection
     * @return $this
     */
    public function setCollection($collection)
    {
        $this->collection= $collection;

        return $this;
    }

    /**
     * @return \Application\Sonata\ClassificationBundle\Entity\Collection
     */
    public function getCollection()
    {
        return $this->collection;
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
    
    public function getPosts() 
    {
        //die(get_class($this->postsManager));
        // get the block view class
        return $this->posts;
    }
    
    public function setPosts() 
    {
        return;
    }
    
    /**
     * 
     */
    public function getDynamicDataManagerName()
    {
        return 'sonata.news.manager.post';
    }
    
    /**
     * 
     */
    public function setDynamicData($data)
    {
        //die(var_dump(array_keys($data)));
        $this->posts = $data;
    }
    
    /**
     * @param array $params
     * @return array
     */
    public function getTemplateOptions($params = array())
    {
        return array(
            'postsListView' => $this
        );
    }

    /**
     * @return array
     */
    public function getAdminContent()
    {
        return array(
            'content' => array('postsListView' => $this),
            'template' => 'LzdvInitCmsPostBundle:PostsListAdmin:posts_list_view_block.html.twig'
        );
    }

    /**
     * @return string
     */
    public function getContentTypeName()
    {
        return 'Posts List Viewer';
    }
    
}
