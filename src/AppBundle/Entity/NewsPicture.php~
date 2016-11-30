<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 06.02.2016
 * Time: 18:21
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\NewsPictureRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table()
 */
class NewsPicture {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $url = '';

    /**
     * @ORM\ManyToOne(targetEntity="News", inversedBy="photos")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $news;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $lat_coord = '';

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $long_coord = '';

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $size = '';

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    private $sizeInt = '';



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
     * Set url
     *
     * @param string $url
     *
     * @return NewsPicture
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set news
     *
     * @param \AppBundle\Entity\News $news
     *
     * @return NewsPicture
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
     * Set latCoord
     *
     * @param string $latCoord
     *
     * @return NewsPicture
     */
    public function setLatCoord($latCoord)
    {
        $this->lat_coord = $latCoord;

        return $this;
    }

    /**
     * Get latCoord
     *
     * @return string
     */
    public function getLatCoord()
    {
        return $this->lat_coord;
    }

    /**
     * Set longCoord
     *
     * @param string $longCoord
     *
     * @return NewsPicture
     */
    public function setLongCoord($longCoord)
    {
        $this->long_coord = $longCoord;

        return $this;
    }

    /**
     * Get longCoord
     *
     * @return string
     */
    public function getLongCoord()
    {
        return $this->long_coord;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return NewsPicture
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set sizeInt
     *
     * @param integer $sizeInt
     *
     * @return NewsPicture
     */
    public function setSizeInt($sizeInt)
    {
        $this->sizeInt = $sizeInt;

        return $this;
    }

    /**
     * Get sizeInt
     *
     * @return integer
     */
    public function getSizeInt()
    {
        return $this->sizeInt;
    }
}
