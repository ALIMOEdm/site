<?php
/**
 * Created by PhpStorm.
 * User: php05
 * Date: 04.03.16
 * Time: 17:39
 */

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PartnersController extends Controller{

    /**
     * @Route("/partners", name="get_partners")
     * @Template()
     */
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:VKGroup')->findAll();

        return array(
            'partners' => $entities
        );
    }
}