<?php
namespace AppBundle\Entity\Traffic;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\Traffic\ZoneRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table()
 */
class Zone {
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
    protected $categoryId;

    /**
     * @ORM\Column(type="integer")
     * @var
     */
    protected $distId;

    /**
     * @ORM\ManyToMany(targetEntity="Route")
     * @ORM\JoinTable(name="zone_to_route",
     *      joinColumns={@ORM\JoinColumn(name="route_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="zone_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    protected $routes;

    protected $routersCache;

    public function serialize()
    {
        $routes = array();
        foreach ($this->getRoutes() as $route) {
            $routes[] = $route->serialize();
        }
        return array(
            'name' => $this->getName(),
            'categoryId' => $this->getCategoryId(),
            'distId' => $this->getDistId(),
            'routes' => $routes,
        );
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->routes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Zone
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
     * Set categoryId
     *
     * @param string $categoryId
     *
     * @return Zone
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return string
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set distId
     *
     * @param integer $distId
     *
     * @return Zone
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
     * Add route
     *
     * @param \AppBundle\Entity\Traffic\Route $route
     *
     * @return Zone
     */
    public function addRoute(\AppBundle\Entity\Traffic\Route $route)
    {
        $this->routes[] = $route;

        return $this;
    }

    /**
     * Remove route
     *
     * @param \AppBundle\Entity\Traffic\Route $route
     */
    public function removeRoute(\AppBundle\Entity\Traffic\Route $route)
    {
        $this->routes->removeElement($route);
    }

    /**
     * Remove all Business needs
     */
    public function removeAllRoutes()
    {
        if(count($this->getRoutes())){
            $n = $this->getRoutes();
            foreach($n as $val){
                $this->removeRoute($val);
            }
        }
    }

    /**
     * Get routes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return mixed
     */
    public function getRoutersCache()
    {
        return $this->routersCache;
    }

    /**
     * @param mixed $routersCache
     */
    public function setRoutersCache($routersCache)
    {
        $this->routersCache = $routersCache;
    }
}
