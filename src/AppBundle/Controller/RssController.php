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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class RssController
 * @package AppBundle\Controller
 */
class RssController extends Controller{

    /**
     * Display RSS
     * @Route("/rss/latest-news", name="get_rss_news")
     * @Template()
     */
    public function indexAction(){
        $format = $this->getParameter('rss_date_format');
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('AppBundle:News')->getLatestNews(3, 1, 'news');

        $entities_news = array();
        if(count($news)){
            foreach($news as $v){
                $e = $v[0];
//                $e = $this->setAdditionalFiledToSkin($v, $e);
                $entities_news[] = $e;
            }
            $lastUpdated = $entities_news[0]->getCreatedAt()->format($format);
        }else{
            $lastUpdated = new \DateTime();
            $lastUpdated = $lastUpdated->format($format);
        }
//        $latest_new = $em->getRepository('AppBundle:News')->getLatestNews(3, 1, 'news');
//        if(count($latest_new)){
//            foreach($latest_new as $v){
//                $e = $v[0];
//                $e = $this->setAdditionalFiledToSkin($v, $e);
//                $entities[] = $e;
//            }
//
//            $lastUpdated = $entities[0]->getCreatedAt()->format($format);
//        }else{
//            $lastUpdated = new \DateTime();
//            $lastUpdated = $lastUpdated->format($format);
//        }

        return array(
            'news' => $entities_news,
            'lastUpdated' => $lastUpdated,
        );
    }

    /**
     * Display RSS
     * @Route("/rss/yandex-chanel", name="get_rss_yandex")
     * @Template("AppBundle:Rss:yandex.html.twig")
     */
    public function getYandexRSS()
    {
        $format = $this->getParameter('rss_date_format');
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('AppBundle:News')->getNewsForYandexRSS(3, 10, 'news');
        $entities_news = array();
        if (count($news)) {
            foreach($news as $v){
                $e = $v[0];
                $e = $this->setAdditionalFiledToSkin($v, $e);
                $entities_news[] = $e;
            }
            $lastUpdated = $entities_news[0]->getCreatedAt()->format($format);
        } else {
            $lastUpdated = new \DateTime();
            $lastUpdated = $lastUpdated->format($format);
        }

        return array(
            'news' => $entities_news,
            'lastUpdated' => $lastUpdated,
        );
    }
}