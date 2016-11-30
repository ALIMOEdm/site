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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class PartnersController
 * @package AppBundle\Controller
 */
class PartnersController extends Controller{

    /**
     * Show partners page
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