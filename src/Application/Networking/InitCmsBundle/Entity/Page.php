<?php
/**
 * This file is part of the init_cms_sandbox package.
 *
 * (c) net working AG <info@networking.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 

namespace Application\Networking\InitCmsBundle\Entity;

use Networking\InitCmsBundle\Entity\BasePage;

/**
 *
 * @author Yorkie Chadwick <y.chadwick@networking.ch>
 */
class Page extends BasePage{


    /**
     * Add menuItem
     *
     * @param \Networking\InitCmsBundle\Entity\MenuItem $menuItem
     *
     * @return Page
     */
    public function addMenuItem(\Networking\InitCmsBundle\Entity\MenuItem $menuItem)
    {
        $this->menuItem[] = $menuItem;
    
        return $this;
    }

    /**
     * Add snapshot
     *
     * @param \Networking\InitCmsBundle\Entity\PageSnapshot $snapshot
     *
     * @return Page
     */
    public function addSnapshot(\Networking\InitCmsBundle\Entity\PageSnapshot $snapshot)
    {
        $this->snapshots[] = $snapshot;
    
        return $this;
    }

    /**
     * Remove snapshot
     *
     * @param \Networking\InitCmsBundle\Entity\PageSnapshot $snapshot
     */
    public function removeSnapshot(\Networking\InitCmsBundle\Entity\PageSnapshot $snapshot)
    {
        $this->snapshots->removeElement($snapshot);
    }

    /**
     * Add child
     *
     * @param \Application\Networking\InitCmsBundle\Entity\Page $child
     *
     * @return Page
     */
    public function addChild(\Application\Networking\InitCmsBundle\Entity\Page $child)
    {
        $this->children[] = $child;
    
        return $this;
    }

    /**
     * Remove child
     *
     * @param \Application\Networking\InitCmsBundle\Entity\Page $child
     */
    public function removeChild(\Application\Networking\InitCmsBundle\Entity\Page $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Add original
     *
     * @param \Application\Networking\InitCmsBundle\Entity\Page $original
     *
     * @return Page
     */
    public function addOriginal(\Application\Networking\InitCmsBundle\Entity\Page $original)
    {
        $this->originals[] = $original;
    
        return $this;
    }

    /**
     * Remove original
     *
     * @param \Application\Networking\InitCmsBundle\Entity\Page $original
     */
    public function removeOriginal(\Application\Networking\InitCmsBundle\Entity\Page $original)
    {
        $this->originals->removeElement($original);
    }
}
