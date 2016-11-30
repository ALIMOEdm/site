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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryNewsController extends Controller{

    /**
     * @Route("/category/{category}/{page}", name="news_by_category")
     * @Template()
     */
    public function indexAction(Request $request, $category, $page = 1){
        $paginator  = $this->get('knp_paginator');

        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AppBundle:News')->getNewsQueryByType($category);
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', $page)/*page number*/,
            20/*limit per page*/
        );

        return array(
            'entities' => $pagination,
            'category' => $category,
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