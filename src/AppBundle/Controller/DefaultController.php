<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
        ));
    }

    /**
     * @Route("/test_api", name="adder")
     * @Template()
     */
    public function testAction($offset = 0)
    {

//        $ch = curl_init('http://amp.gs/8u9i');
//        curl_exec($ch);
//        $info = curl_getinfo($ch);
//        var_dump($info);
//
//
//        die;
        header('Content-Type: text/html; charset=utf-8');
        $group = '-71731022';//amic
//        $group = '-20351570';//altapress
//        $group = '-56877418';//alt_brn_news
//        $group = '-66778909';
//        $group = '-113426229';
//        $group = '-113535804';
//        try {
////            $this->get('app.news_downloader')->requestForNew($group, 'amic', 1, $offset);
//            $this->get('app.news_downloader')->requestForNew($group, '', 1, 0);
//
//        } catch (\Exception $e) {
//            return array('result' => $e->getMessage());
//        }

        $this->get('app.traffic_manager')->refreshData();
        return array('result' => 'OK');
    }

    /**
     * @Route("/test_map", name="test_map")
     * @Template()
     */
    public function testMapAction($offset = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $route_rep = $em->getRepository('AppBundle:Traffic\Route');
        $station_rep = $em->getRepository('AppBundle:Traffic\Station');
        $zone_rep = $em->getRepository('AppBundle:Traffic\Zone');

        $routes = $route_rep->findAll();
        $routes_array = array();
        foreach ($routes as $r) {
            $routes_array[] = $r->serialize();
        }

        $stations = $station_rep->findAll();
        $stations_array = array();
        foreach ($stations as $r) {
            $stations_array[] = $r->serialize();
        }

        $zones = $zone_rep->getZones();
        $zones_array = array();
        foreach ($zones as $r) {
            $zones_array[] = $r->serialize();
        }

        return array(
            'routes' => json_encode($routes_array),
            'stations' => json_encode($stations_array),
            'zones' => json_encode($zones_array),
        );
    }

    /**
     * Site main page
     * @Route("/{page}", name="homepage", requirements={
     *     "page": "\d+"
     * })
     * @Template()
     */
    public function indexNewsAction(Request $request, $page = 1)
    {
        $em = $this->getDoctrine()->getManager();
        $category = 'news';
        $data = $this->setFilters($request, 'filter_data_main_page');

        $date_start = $data['date_start'];
        $date_finish = $data['date_finish'];
        $need_groups = $data['groups'];
        $search_words = $data['search_words'];
        $date_interval = $data['date_interval'];

        $query = $this->constructConditionForCommentSearch($search_words);

        $query = $em->getRepository('AppBundle:News')->getListOfNewsQuery($date_start, $date_finish, $need_groups, $query);

        $groups = $em->getRepository('AppBundle:VKGroup')->getGroupsFormMainPage();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', $page)/*page number*/,
            $this->getParameter('number_of_article_on_main_page')/*limit per page*/
        );

        if(count($entities)){
            if(is_array($entities[0])){
                $temp = array();
                foreach($entities->getItems() as $ent){
                    $e = $ent[0];
                    $e = $this->setAdditionalFiledToSkin($ent, $e);
                    $temp[] = $e;
                }
                $entities->setItems($temp);
            }
        }

        return array(
            'entities' => $entities,
            'groups' => $groups,
            'need_groups' => $need_groups,
            'date_start' => $date_start,
            'date_finish' => $date_finish,
            'filter_path' => $this->generateUrl('homepage', array(), UrlGeneratorInterface::ABSOLUTE_URL),
            'search_words' => $search_words,
            'date_interval' => $date_interval,
            'category_'.$category => $category,
        );
    }

    /**
     * @Route("/get-all-groups", name="get_all_groups")
     * @Template()
     * @return mixed
     */
    public function getGroupsAction($selected_groups = array())
    {
        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository('AppBundle:VKGroup')->getAllGroup();
        return array(
            'groups' => $groups,
            'selected_groups' => $selected_groups,
        );
    }

    /**
     * Get latest news
     * @param int $limit
     * @return mixed
     */
    public function getLatestNewsAction($limit = 3)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('AppBundle:News')->getLatestNews(3, $limit, 'different');

        if(count($news)){
            if(is_array($news[0])){
                $temp = array();
                foreach($news as $ent){
                    $e = $ent[0];
                    $e = $this->setAdditionalFiledToSkin($ent, $e);
                    $temp[] = $e;
                }
                $news = $temp;
            }
        }
        return $this->render('AppBundle:Default:sub_templates/different_news_list.html.twig', array(
            'different' => $news,
        ));
    }

    /**
     * @Route("/api/get-currency-rate", name="currency_rate")
     */
    public function getCurrencyRate(Request $request){
        $res = $this->get('app.currency_rate')->getInformation();
        $result = array(
            'success' => true,
            'data' => $res,
        );
        return new JsonResponse($result);
    }

    /**
     * @Route("/api/weather-forecast", name="currency_weather_forecast")
     */
    public function test(){
        $result = array(
            'success' => true,
        );
        try{
            $result['data'] = $this->get('app.receive_weather')->getInformation();
        }
        catch(\Exception $e){
            $result = array(
                'success' => false,
            );
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/celebrate", name="get_celebrate")
     */
    public function getCelebrate()
    {
        $res = $this->get('app.celebrate')->getInformation();
        $result = array(
            'success' => true,
            'data' => $res,
        );
        return new JsonResponse($result);
    }

    /**
     * @Route("/popular-news", name="get_popular_news")
     * @Template()
     */
    public function popularNewsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $news = array();

        $pop_news_ids = $this->get('app.popular_news')->getInformation();
        $pop_news_ids = isset($pop_news_ids['popular_news']) ? $pop_news_ids['popular_news'] : '';

        if (!$pop_news_ids) {
            return array(
                'news' => $news,
            );
        }

        $news = $em->getRepository('AppBundle:News')->getNewsById(explode(',', $pop_news_ids));
        if (count($news)) {
            foreach ($news as &$n) {
                $e = $n[0];
                $e = $this->setAdditionalFiledToSkin($n, $e);
                $n = $e;
            }
            unset($n);
        }

        return array(
            'news' => $news,
        );
    }
}