<?php
/**
 * Created by PhpStorm.
 * User: php05
 * Date: 17.05.16
 * Time: 12:14
 */

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class JobController {

    /**
     * Get Discounts
     * @Route("/job/{page}", name="job_searcher_index")
     * @Template()
     */
    public function indexAction(Request $request, $page = 1){
        $category = 'job_seacher';
        return array(
            'category_'.$category => $category,
        );
    }
}