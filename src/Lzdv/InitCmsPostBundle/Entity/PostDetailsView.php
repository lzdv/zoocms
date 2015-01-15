<?php

namespace Lzdv\InitCmsPostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

use JMS\Serializer\Annotation\Type;

use Networking\InitCmsBundle\Model\ContentInterface;
use Lzdv\InitCmsPostBundle\Entity\PostDetailsViewInterface;
use Networking\InitCmsBundle\Entity\DynamicLayoutBlockInterface;

use Application\Sonata\ClassificationBundle\Entity\PostDetails;

/**
 * PostDetailsView
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="post_details_view")
 * @ORM\Entity
 */
class PostDetailsView implements PostDetailsViewInterface, DynamicLayoutBlockInterface
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
     * @var PostDetails $post
     * @Type("Application\Sonata\PostBundle\Entity\Wine")
     */
    private $post;
    
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

    public function getPost() 
    {
        //die(get_class($this->postsManager));
        // get the block view class
        return $this->post;
    }
    
    public function setPost() 
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
        $this->post = $data;
    }
    
    /**
     * @param array $params
     * @return array
     */
    public function getTemplateOptions($params = array())
    {
        return array(
            'postDetailsView' => $this
        );
    }

    /**
     * @return array
     */
    public function getAdminContent()
    {
        return array(
            'content' => array('postDetailsView' => $this),
            'template' => 'LzdvInitCmsPostBundle:PostDetailsAdmin:post_details_view_block.html.twig'
        );
    }

    /**
     * @return string
     */
    public function getContentTypeName()
    {
        return 'Post Details Viewer';
    }
    
}
