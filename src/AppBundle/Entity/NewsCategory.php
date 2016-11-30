<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 16.04.2016
 * Time: 17:11
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\NewsCategoryRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table()
 */
class NewsCategory {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $indentity;

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
     * @return NewsCategory
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
     * Set indentity
     *
     * @param string $indentity
     *
     * @return NewsCategory
     */
    public function setIndentity($indentity)
    {
        $this->indentity = $indentity;

        return $this;
    }

    /**
     * Get indentity
     *
     * @return string
     */
    public function getIndentity()
    {
        return $this->indentity;
    }
}
