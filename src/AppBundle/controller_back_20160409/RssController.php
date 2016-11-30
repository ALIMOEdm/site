<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 08.03.2016
 * Time: 23:03
 */

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RssController extends Controller{

    /**
     * @Route("/rss/latest-news", name="get_rss_news")
     * @Template()
     */
    public function indexAction(){
        $format = $this->getParameter('rss_date_format');
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('AppBundle:News')->getLatestNews(3, 1, 'news');

        $latest_new = $em->getRepository('AppBundle:News')->getLatestNews(3, 1, 'news');
        if(count($latest_new)){
            $lastUpdated = $latest_new[0]->getCreatedAt()->format($format);
        }else{
            $lastUpdated = new \DateTime();
            $lastUpdated = $lastUpdated->format($format);
        }

        return array(
            'news' => $news,
            'lastUpdated' => $lastUpdated,
        );
    }
}