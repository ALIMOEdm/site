<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 16.04.2016
 * Time: 23:16
 */

namespace AppBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class RemoveWrongNews {

    private $container;
    public function __construct(Container $container){
        $this->container = $container;
    }

    public function removeWrongNews(){
        $em = $this->container->get('doctrine.orm.entity_manager');
        $news = $em->getRepository('AppBundle:News')->getWrongNews();
        if(count($news)){
            foreach($news as $n){
                $em->remove($n);
            }
        }
    }
}