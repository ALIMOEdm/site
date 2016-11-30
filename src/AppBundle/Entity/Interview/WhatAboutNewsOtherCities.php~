<?php

namespace AppBundle\Entity\Interview;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Хотели бы вы видеть новости других городов?
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\Interview\WhatAboutNewsOtherCitiesRepository")
 * @ORM\HasLifecycleCallbacks
 */
class WhatAboutNewsOtherCities extends InterviewQuestionsBase{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * Set title
     *
     * @param string $title
     *
     * @return WhatAboutNewsOtherCities
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return WhatAboutNewsOtherCities
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}
