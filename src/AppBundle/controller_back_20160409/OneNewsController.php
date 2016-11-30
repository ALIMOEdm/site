<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 14.02.2016
 * Time: 9:50
 */

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class OneNewsController extends Controller{

    /**
     * @Route("/news/{gr_news_id}", name="one_news_router")
     * @Template()
     */
    public function indexAction(Request $request, $gr_news_id){
        $em = $this->getDoctrine()->getManager();
        $news_repository = $em->getRepository('AppBundle:News');

        list($group_id, $news_id) = explode('_', $gr_news_id);


        $one_news = $news_repository->getNewsByNewsIdAndVkId($news_id, -$group_id);

        return array(
            'news' => $one_news,
        );
    }
}