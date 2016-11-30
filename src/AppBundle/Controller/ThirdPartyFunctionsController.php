<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 05.03.2016
 * Time: 20:32
 */

namespace AppBundle\Controller;


use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ThirdPartyFunctionsController
 * @package AppBundle\Controller
 */
class ThirdPartyFunctionsController extends Controller{

    /**
     * About page
     * @Route("/about", name="get_about")
     * @Template()
     */
    public function aboutAction(){
        return array();
    }
    /**
     * Adverts page
     * @Route("/adverts", name="get_adverts")
     * @Template()
     */
    public function advertsAction(){
        return array();
    }
}