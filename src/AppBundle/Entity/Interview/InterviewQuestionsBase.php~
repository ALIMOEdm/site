<?php

namespace AppBundle\Entity\Interview;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/** @ORM\MappedSuperclass */
class InterviewQuestionsBase {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var
     */
    protected $title;

    /**
     * @ORM\Column(type="boolean")
     * @var
     */
    protected $deleted = 0;
}
