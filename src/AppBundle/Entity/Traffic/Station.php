<?php
namespace AppBundle\Entity\Traffic;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\Traffic\StationRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table()
 */
class Station {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @var
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     * @var
     */
    protected $cLat;

    /**
     * @ORM\Column(type="integer")
     * @var
     */
    protected $cLong;

    /**
     * @ORM\Column(type="string")
     * @var
     */
    protected $stationType;

    /**
     * @ORM\Column(type="integer")
     * @var
     */
    protected $distId;

    public function serialize()
    {
        return array(
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'lat' => $this->getCLat(),
            'long' => $this->getCLong(),
            'stationType' => $this->getStationType(),
            'distId' => $this->getDistId(),
        );
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
     * Set name
     *
     * @param string $name
     *
     * @return Station
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Station
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

    /**
     * Set distId
     *
     * @param integer $distId
     *
     * @return Station
     */
    public function setDistId($distId)
    {
        $this->distId = $distId;

        return $this;
    }

    /**
     * Get distId
     *
     * @return integer
     */
    public function getDistId()
    {
        return $this->distId;
    }

    /**
     * Set cLat
     *
     * @param integer $cLat
     *
     * @return Station
     */
    public function setCLat($cLat)
    {
        $this->cLat = $cLat;

        return $this;
    }

    /**
     * Get cLat
     *
     * @return integer
     */
    public function getCLat()
    {
        return $this->cLat;
    }

    /**
     * Set cLong
     *
     * @param integer $cLong
     *
     * @return Station
     */
    public function setCLong($cLong)
    {
        $this->cLong = $cLong;

        return $this;
    }

    /**
     * Get cLong
     *
     * @return integer
     */
    public function getCLong()
    {
        return $this->cLong;
    }

    /**
     * Set stationType
     *
     * @param string $stationType
     *
     * @return Station
     */
    public function setStationType($stationType)
    {
        $this->stationType = $stationType;

        return $this;
    }

    /**
     * Get stationType
     *
     * @return string
     */
    public function getStationType()
    {
        return $this->stationType;
    }
}
