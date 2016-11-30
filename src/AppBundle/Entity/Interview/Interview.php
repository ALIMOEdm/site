<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 06.02.2016
 * Time: 17:43
 */

namespace AppBundle\Entity\Interview;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\Interview\InterviewRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table()
 */
class Interview {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Interview\Site")
     * @ORM\JoinTable(name="int_sites",
     *      joinColumns={@ORM\JoinColumn(name="interview_id_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="answer_id", referencedColumnName="id")}
     *      )
     */
    private $sites;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Interview\SiteVisitFrencity")
     * @ORM\JoinColumn(name="frencity_id", referencedColumnName="id")
     */
    private $frencity_site_visit;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Interview\SiteVisitNumber")
     * @ORM\JoinColumn(name="site_visit_id", referencedColumnName="id")
     */
    private $number_of_sites_u_see;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Interview\WhatImportant")
     * @ORM\JoinTable(name="int_importance",
     *      joinColumns={@ORM\JoinColumn(name="interview_id_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="answer_id", referencedColumnName="id")}
     *      )
     */
    private $what_important;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Interview\WhatFunctional")
     * @ORM\JoinTable(name="int_functional",
     *      joinColumns={@ORM\JoinColumn(name="interview_id_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="answer_id", referencedColumnName="id")}
     *      )
     */
    private $what_functional;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Interview\WhatAboutNewsOtherCities")
     * @ORM\JoinTable(name="int_other_sites",
     *      joinColumns={@ORM\JoinColumn(name="interview_id_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="answer_id", referencedColumnName="id")}
     *      )
     */
    private $news_other_cities;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->what_important = new \Doctrine\Common\Collections\ArrayCollection();
        $this->what_functional = new \Doctrine\Common\Collections\ArrayCollection();
        $this->news_other_cities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add site
     *
     * @param \AppBundle\Entity\Interview\Site $site
     *
     * @return Interview
     */
    public function addSite(\AppBundle\Entity\Interview\Site $site)
    {
        $this->sites[] = $site;

        return $this;
    }

    /**
     * Remove site
     *
     * @param \AppBundle\Entity\Interview\Site $site
     */
    public function removeSite(\AppBundle\Entity\Interview\Site $site)
    {
        $this->sites->removeElement($site);
    }

    /**
     * Get sites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * Set frencitySiteVisit
     *
     * @param \AppBundle\Entity\Interview\SiteVisitFrencity $frencitySiteVisit
     *
     * @return Interview
     */
    public function setFrencitySiteVisit(\AppBundle\Entity\Interview\SiteVisitFrencity $frencitySiteVisit = null)
    {
        $this->frencity_site_visit = $frencitySiteVisit;

        return $this;
    }

    /**
     * Get frencitySiteVisit
     *
     * @return \AppBundle\Entity\Interview\SiteVisitFrencity
     */
    public function getFrencitySiteVisit()
    {
        return $this->frencity_site_visit;
    }

    /**
     * Set numberOfSitesUSee
     *
     * @param \AppBundle\Entity\Interview\SiteVisitNumber $numberOfSitesUSee
     *
     * @return Interview
     */
    public function setNumberOfSitesUSee(\AppBundle\Entity\Interview\SiteVisitNumber $numberOfSitesUSee = null)
    {
        $this->number_of_sites_u_see = $numberOfSitesUSee;

        return $this;
    }

    /**
     * Get numberOfSitesUSee
     *
     * @return \AppBundle\Entity\Interview\SiteVisitNumber
     */
    public function getNumberOfSitesUSee()
    {
        return $this->number_of_sites_u_see;
    }

    /**
     * Add whatImportant
     *
     * @param \AppBundle\Entity\Interview\WhatImportant $whatImportant
     *
     * @return Interview
     */
    public function addWhatImportant(\AppBundle\Entity\Interview\WhatImportant $whatImportant)
    {
        $this->what_important[] = $whatImportant;

        return $this;
    }

    /**
     * Remove whatImportant
     *
     * @param \AppBundle\Entity\Interview\WhatImportant $whatImportant
     */
    public function removeWhatImportant(\AppBundle\Entity\Interview\WhatImportant $whatImportant)
    {
        $this->what_important->removeElement($whatImportant);
    }

    /**
     * Get whatImportant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWhatImportant()
    {
        return $this->what_important;
    }

    /**
     * Add whatFunctional
     *
     * @param \AppBundle\Entity\Interview\WhatFunctional $whatFunctional
     *
     * @return Interview
     */
    public function addWhatFunctional(\AppBundle\Entity\Interview\WhatFunctional $whatFunctional)
    {
        $this->what_functional[] = $whatFunctional;

        return $this;
    }

    /**
     * Remove whatFunctional
     *
     * @param \AppBundle\Entity\Interview\WhatFunctional $whatFunctional
     */
    public function removeWhatFunctional(\AppBundle\Entity\Interview\WhatFunctional $whatFunctional)
    {
        $this->what_functional->removeElement($whatFunctional);
    }

    /**
     * Get whatFunctional
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWhatFunctional()
    {
        return $this->what_functional;
    }

    /**
     * Add newsOtherCity
     *
     * @param \AppBundle\Entity\Interview\WhatAboutNewsOtherCities $newsOtherCity
     *
     * @return Interview
     */
    public function addNewsOtherCity(\AppBundle\Entity\Interview\WhatAboutNewsOtherCities $newsOtherCity)
    {
        $this->news_other_cities[] = $newsOtherCity;

        return $this;
    }

    /**
     * Remove newsOtherCity
     *
     * @param \AppBundle\Entity\Interview\WhatAboutNewsOtherCities $newsOtherCity
     */
    public function removeNewsOtherCity(\AppBundle\Entity\Interview\WhatAboutNewsOtherCities $newsOtherCity)
    {
        $this->news_other_cities->removeElement($newsOtherCity);
    }

    /**
     * Get newsOtherCities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsOtherCities()
    {
        return $this->news_other_cities;
    }
}
