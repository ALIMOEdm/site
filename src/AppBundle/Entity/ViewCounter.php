<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 26.04.2016
 * Time: 21:08
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ViewCounterRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table()
 */
class ViewCounter {

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
     * @ORM\ManyToOne(targetEntity="News", inversedBy="views")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id", onDelete="CASCADE")
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
     * @return ViewCounter
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
     * Set news
     *
     * @param \AppBundle\Entity\News $news
     *
     * @return ViewCounter
     */
    public function setNews(\AppBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \AppBundle\Entity\News
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set visitedDate
     *
     * @ORM\PrePersist()
     *
     * @param \DateTime $visitedDate
     *
     * @return ViewCounter
     */
    public function setVisitedDate($visitedDate = null)
    {
        if($visitedDate instanceof \DateTime){
            $this->visited_date = $visitedDate;
        }
        else{
            $this->visited_date = new \DateTime();
        }

        return $this;
    }

    /**
     * Get visitedDate
     *
     *
     * @return \DateTime
     */
    public function getVisitedDate()
    {
        return $this->visited_date;
    }
}
