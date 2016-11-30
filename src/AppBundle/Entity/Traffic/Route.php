<?php
namespace AppBundle\Entity\Traffic;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\Traffic\RouteRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table()
 */
class Route {
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
    protected $type;

    /**
     * @ORM\Column(type="string")
     * @var
     */
    protected $num;

    /**
     * @ORM\Column(type="string")
     * @var
     */
    protected $fromSt;

    /**
     * @ORM\Column(type="integer")
     * @var
     */
    protected $fromStId;

    /**
     * @ORM\Column(type="string")
     * @var
     */
    protected $toSt;

    /**
     * @ORM\Column(type="integer")
     * @var
     */
    protected $toStId;

    /**
     * @ORM\Column(type="integer")
     * @var
     */
    protected $distId;

    public function serialize()
    {
        return array(
            'name' => $this->getName(),
            'type' => $this->getType(),
            'num' => $this->getNum(),
            'fromSt' => $this->getFromSt(),
            'fromStId' => $this->getFromStId(),
            'toSt' => $this->getToSt(),
            'toStId' => $this->getToStId(),
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
     * @return Route
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
     * Set type
     *
     * @param string $type
     *
     * @return Route
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set num
     *
     * @param string $num
     *
     * @return Route
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set fromSt
     *
     * @param string $fromSt
     *
     * @return Route
     */
    public function setFromSt($fromSt)
    {
        $this->fromSt = $fromSt;

        return $this;
    }

    /**
     * Get fromSt
     *
     * @return string
     */
    public function getFromSt()
    {
        return $this->fromSt;
    }

    /**
     * Set fromStId
     *
     * @param integer $fromStId
     *
     * @return Route
     */
    public function setFromStId($fromStId)
    {
        $this->fromStId = $fromStId;

        return $this;
    }

    /**
     * Get fromStId
     *
     * @return integer
     */
    public function getFromStId()
    {
        return $this->fromStId;
    }

    /**
     * Set toSt
     *
     * @param string $toSt
     *
     * @return Route
     */
    public function setToSt($toSt)
    {
        $this->toSt = $toSt;

        return $this;
    }

    /**
     * Get toSt
     *
     * @return string
     */
    public function getToSt()
    {
        return $this->toSt;
    }

    /**
     * Set toStId
     *
     * @param integer $toStId
     *
     * @return Route
     */
    public function setToStId($toStId)
    {
        $this->toStId = $toStId;

        return $this;
    }

    /**
     * Get toStId
     *
     * @return integer
     */
    public function getToStId()
    {
        return $this->toStId;
    }

    /**
     * Set distId
     *
     * @param integer $distId
     *
     * @return Route
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
}
