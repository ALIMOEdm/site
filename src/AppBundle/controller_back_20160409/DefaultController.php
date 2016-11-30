<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/test_api", name="adder")
     * @Template()
     */
    public function testAction($offset = 0){
        header('Content-Type: text/html; charset=utf-8');
        $group = '-71731022';//amic
//        $group = '-20351570';//altapress
//        $group = '-56877418';//alt_brn_news
        $group = '-38551279';
        $group = '-113426229';
        try{
//            $this->get('app.news_downloader')->requestForNew($group, 'amic', 1, $offset);
            $this->get('app.news_downloader')->requestForNew($group,'', 1,0);

        }catch (\Exception $e){
            return array('result' => $e->getMessage());
        }
        return array('result' => 'OK');
    }
//    /**
//     * @Route("/", name="homepage")
//     * @Template()
//     */
    public function indexNewsAction(){
        $em = $this->getDoctrine()->getManager();

        $main_news = $em->getRepository('AppBundle:News')->getMainNews(4);

        $offset = count($main_news);

        $main_news_sec_row = $em->getRepository('AppBundle:News')->getMainNews(9,$offset);

        $arr = array();
        foreach($main_news as $n){
            $arr[] = $n->getId();
        }

        foreach($main_news_sec_row as $n){
            $arr[] = $n->getId();
        }

        $not_in_str = implode(',', $arr);
        $main_news_3 = $em->getRepository('AppBundle:News')->getMainNewsSecond($not_in_str, 1, 0);
        if(count($main_news_3)){
            $main_news_3 = $main_news_3[0];
        }
        $offset = count($main_news_3);
        $main_news_4 = $em->getRepository('AppBundle:News')->getMainNewsSecond($not_in_str, 6, $offset);
        $offset += count($main_news_4);
        $main_news_5 = $em->getRepository('AppBundle:News')->getMainNewsSecond($not_in_str, 6, $offset);

        $offset = 0;
        $sport_news_1 = $em->getRepository('AppBundle:News')->getSportNews(1, $offset);
        if(count($sport_news_1)){
            $sport_news_1 = $sport_news_1[0];
        }

        $offset += count($sport_news_1);
        $sport_news_2 = $em->getRepository('AppBundle:News')->getSportNews(4, $offset);
        $offset += count($sport_news_2);
        $sport_news_3 = $em->getRepository('AppBundle:News')->getSportNews(4, $offset);


        $different = $em->getRepository('AppBundle:News')->getDifferentNews(16, 0);
        $different_2 = $em->getRepository('AppBundle:News')->getDifferentNews(16, 16);


        $offset = 0;
        $travel_news_1 = $em->getRepository('AppBundle:News')->getTravelNews(1, $offset);
        if(count($travel_news_1)){
            $travel_news_1 = $travel_news_1[0];
        }

        $offset += count($travel_news_1);
        $travel_news_2 = $em->getRepository('AppBundle:News')->getTravelNews(4, $offset);

        $offset = 0;
        $afisha_news_1 = $em->getRepository('AppBundle:News')->getAfisha(1, $offset);
        if(count($afisha_news_1)){
            $afisha_news_1 = $afisha_news_1[0];
        }

        $offset += count($afisha_news_1);
        $afisha_news_2 = $em->getRepository('AppBundle:News')->getAfisha(4, $offset);


//        $offset = 0;
//        $laska_news_1 = $em->getRepository('AppBundle:News')->getLaskaPriut(1, $offset);
//        if(count($laska_news_1)){
//            $laska_news_1 = $laska_news_1[0];
//        }
//
//        $offset += count($laska_news_1);
//        $laska_news_2 = $em->getRepository('AppBundle:News')->getLaskaPriut(4, $offset);


        $offset = 0;
        $laska_news_1 = $em->getRepository('AppBundle:News')->getDifferentNews(1, $offset);
        if(count($laska_news_1)){
            $laska_news_1 = $laska_news_1[0];
        }

        $offset += count($laska_news_1);
        $laska_news_2 = $em->getRepository('AppBundle:News')->getDifferentNews(4, $offset);



        return array(
            'main_news' => $main_news,
            'main_news_sec_row' => $main_news_sec_row,
            'main_news_3' => $main_news_3,
            'main_news_4' => $main_news_4,
            'main_news_5' => $main_news_5,
            'sport_news_1' => $sport_news_1,
            'sport_news_2' => $sport_news_2,
            'sport_news_3' => $sport_news_3,
            'different' => $different,
            'different_2' => $different_2,
            'travel_news_1' => $travel_news_1,
            'travel_news_2' => $travel_news_2,
            'afisha_news_1' => $afisha_news_1,
            'afisha_news_2' => $afisha_news_2,
            'laska_news_1' => $laska_news_1,
            'laska_news_2' => $laska_news_2,

        );
    }


    public function getLatestNewsAction($limit = 3){
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('AppBundle:News')->getLatestNews(3, $limit);

        return $this->render('AppBundle:Default:sub_templates/different_news_list.html.twig', array(
            'different' => $news,
        ));
    }



//    /**
//     * @Route("/test2/ttt", name="test")
//     * @Template()
//     */
//    public function test3Action(){
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('AppBundle:News')->findAll();
//
//        return array(
//            'entities' => $entities
//        );
//    }
}
