<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 10.05.2016
 * Time: 21:18
 */

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DiscountController extends Controller{

    /**
     * Get Discounts
     * @Route("/discounts/{page}", name="discounts_index")
     * @Template()
     */
    public function indexAction(Request $request, $page = 1){
        $paginator  = $this->get('knp_paginator');
        $category = 'discount';
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AppBundle:News')->getNewsQueryByType($category, 0, 0);
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

        return array(
            'entities' => $entities,
            'category' => $category,
            'category_'.$category => $category,
        );
    }
}