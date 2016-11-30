<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 26.04.2016
 * Time: 21:08
 */

namespace AppBundle\Entity\UserNews;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserNewsViewCounterRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table()
 */
class UserNewsViewCounter {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $ip;

    /**
     * @ORM\ManyToOne(targetEntity="UserNews", inversedBy="views")
     * @ORM\JoinColumn(name="user_news_id", referencedColumnName="id")
     */
    private $news;

    /**
     * @ORM\Column(type="datetime")
     */
    private $visited_date;


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
     * Set ip
     *
     * @param string $ip
     *
     * @return UserNewsViewCounter
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set visitedDate
     *
     * @param \DateTime $visitedDate
     *
     * @return UserNewsViewCounter
     */
    public function setVisitedDate($visitedDate)
    {
        $this->visited_date = $visitedDate;

        return $this;
    }

    /**
     * Get visitedDate
     *
     * @return \DateTime
     */
    public function getVisitedDate()
    {
        return $this->visited_date;
    }

    /**
     * Set news
     *
     * @param \AppBundle\Entity\UserNews\UserNews $news
     *
     * @return UserNewsViewCounter
     */
    public function setNews(\AppBundle\Entity\UserNews\UserNews $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \AppBundle\Entity\UserNews\UserNews
     */
    public function getNews()
    {
        return $this->news;
    }
}
