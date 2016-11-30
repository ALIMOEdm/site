<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\VKGroupRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(indexes={@ORM\Index(name="theme_index", columns={"group_theme"})})
 */
class VKGroup {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="NewsCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\Column(type="string")
     */
    private $group_id;
    /**
     * @ORM\Column(type="string")
     */
    private $group_name;
    /**
     * @ORM\Column(type="string")
     */
    private $group_theme = '';

    /**
     * @ORM\Column(type="string")
     */
    private $group_title = '';

    /**
     * @ORM\Column(type="string")
     */
    private $group_url = '';

    /**
     * @ORM\Column(type="datetime")
     */
    private $requested_date = '';

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted = false;

    /**
     * @ORM\OneToMany(targetEntity="News", mappedBy="vk_group")
     */
    private $news;

    /**
     * @ORM\Column(type="string")
     */
    private $logo;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

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
     * Set group_id
     *
     * @param string $groupId
     * @return VKGroup
     */
    public function setGroupId($groupId)
    {
        $this->group_id = $groupId;

        return $this;
    }

    /**
     * Get group_id
     *
     * @return string 
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * Set group_name
     *
     * @param string $groupName
     * @return VKGroup
     */
    public function setGroupName($groupName)
    {
        $this->group_name = $groupName;

        return $this;
    }

    /**
     * Get group_name
     *
     * @return string 
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * Set group_theme
     *
     * @param string $groupTheme
     * @return VKGroup
     */
    public function setGroupTheme($groupTheme)
    {
        $this->group_theme = $groupTheme;

        return $this;
    }

    /**
     * Get group_theme
     *
     * @return string 
     */
    public function getGroupTheme()
    {
        return $this->group_theme;
    }

    /**
     * Set requested_date
     *
     * @param \DateTime $requestedDate
     * @return VKGroup
     */
    public function setRequestedDate($requestedDate)
    {
        $this->requested_date = $requestedDate;

        return $this;
    }

    /**
     * Get requested_date
     *
     * @return \DateTime 
     */
    public function getRequestedDate()
    {
        return $this->requested_date;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return VKGroup
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

    /**
     * Set groupTitle
     *
     * @param string $groupTitle
     *
     * @return VKGroup
     */
    public function setGroupTitle($groupTitle)
    {
        $this->group_title = $groupTitle;

        return $this;
    }

    /**
     * Get groupTitle
     *
     * @return string
     */
    public function getGroupTitle()
    {
        return $this->group_title;
    }

    /**
     * Set groupUrl
     *
     * @param string $groupUrl
     *
     * @return VKGroup
     */
    public function setGroupUrl($groupUrl)
    {
        $this->group_url = $groupUrl;

        return $this;
    }

    /**
     * Get groupUrl
     *
     * @return string
     */
    public function getGroupUrl()
    {
        return $this->group_url;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add news
     *
     * @param \AppBundle\Entity\News $news
     *
     * @return VKGroup
     */
    public function addNews(\AppBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \AppBundle\Entity\News $news
     */
    public function removeNews(\AppBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\NewsCategory $category
     *
     * @return VKGroup
     */
    public function setCategory(\AppBundle\Entity\NewsCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\NewsCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return VKGroup
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return VKGroup
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
