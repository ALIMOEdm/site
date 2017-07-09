<?php

namespace AppBundle\Entity\Information;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\Information\AdditionalInfoRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(indexes={@ORM\Index(name="key_index", columns={"param_name"})})
 */
class AdditionalInfo {

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
    protected $param_name;

    /**
     * @ORM\Column(type="string")
     * @var
     */
    protected $param_value;

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
     * Set paramName
     *
     * @param string $paramName
     *
     * @return AdditionalInfo
     */
    public function setParamName($paramName)
    {
        $this->param_name = $paramName;

        return $this;
    }

    /**
     * Get paramName
     *
     * @return string
     */
    public function getParamName()
    {
        return $this->param_name;
    }

    /**
     * Set paramValue
     *
     * @param string $paramValue
     *
     * @return AdditionalInfo
     */
    public function setParamValue($paramValue)
    {
        $this->param_value = $paramValue;

        return $this;
    }

    /**
     * Get paramValue
     *
     * @return string
     */
    public function getParamValue()
    {
        return $this->param_value;
    }
}
