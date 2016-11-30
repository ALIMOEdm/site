<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 14.02.2016
 * Time: 14:48
 */

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class CategoryNewsController
 * @package AppBundle\Controller
 */
class CategoryNewsController extends Controller{

    /**
     * Get news by category
     * @Route("/category/{category}/{page}", name="news_by_category")
     * @Template()
     */
    public function indexAction(Request $request, $category, $page = 1){
        $paginator  = $this->get('knp_paginator');

        $data = $this->setFilters($request, 'filter_data_'.$category);
        $date_start = $data['date_start'];
        $date_finish = $data['date_finish'];
        $need_groups = $data['need_groups'];
        $search_words = $data['search_words'];

        $query_search = $this->constructConditionForCommentSearch($search_words);

        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AppBundle:News')->getNewsQueryByType($category, 0, 0, $date_start, $date_finish, $need_groups, false, $query_search);
        $entities = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', $page)/*page number*/,
            $this->getParameter('number_of_article_on_category_page')/*limit per page*/
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
        $groups = $em->getRepository('AppBundle:VKGroup')->getGroupsCategory($category);

        return array(
            'entities' => $entities,
            'category' => $category,
            'category_'.$category => $category,
//            'groups' => $groups,
//            'need_groups' => json_encode($need_groups),
//            'date_start' => $date_start,
//            'date_finish' => $date_finish,
//            'filter_path' => $this->generateUrl('news_by_category', array('category' => $category), UrlGeneratorInterface::ABSOLUTE_URL),
//            'search_words' => $search_words,
        );
    }


    /**
     * @Route("/ajax-category/get-more-news", name="get_more_news")
     * @Template()
     */
    public function getMoreNewsAction(Request $request){
        $offset = $request->request->get('offset', 0);
        $category = $request->request->get('category', 0);
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:News')->getNewsQueryByType($category, 10, $offset, true);

        $offset += count($entities);
        return new JsonResponse(array(
            'success' => true,
            'html' => $this->renderView('AppBundle:CategoryNews:category_news_list.html.twig', array(
                'entities' => $entities,
            )),
            'offset' => $offset,
        ));
    }
}