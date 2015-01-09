<?php

namespace Lzdv\InitCmsMapBundle\Entity;

use Networking\InitCmsBundle\Model\ContentInterface;
use Ibrows\Bundle\SonataAdminAnnotationBundle\Annotation as Sonata;

/**
 * Networking\MapElementBundle\Entity\MapElementViewInterface
 *
 */
interface MapElementViewInterface extends ContentInterface
{
    /**
     * @param  string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param  string $payoff
     * @return $this
     */
    public function setPayoff($payoff);

    /**
     * @return string
     */
    public function getPayoff();

    /**
     * @param  string $name
     * @return $this
     */
    public function setText($text);

    /**
     * @return string
     */
    public function getText();

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
}
