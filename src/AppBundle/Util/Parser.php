<?php
/**
 * Created by PhpStorm.
 * User: php05
 * Date: 12.02.16
 * Time: 9:58
 */

namespace AppBundle\Util;


class Parser {
    protected  $finder;
    protected function removeElementByXpath($xpath){
        $nodes = $this->finder->query($xpath);
        $domElemsToRemove = array();
        foreach($nodes as $node){
            if(!is_null($node->tagName)){
                $domElemsToRemove[] = $node;
            }
        }
        foreach( $domElemsToRemove as $domElement ){
            $domElement->parentNode->removeChild($domElement);
        }
    }

    public function getArticle($url)
    {
        $url = preg_replace('/<\/?[^>]*>/', '', $url);
        return file_get_contents($url);
    }
    protected function getSetOfNodesByXpath($xpath)
    {
        return $this->finder->query($xpath);
    }
}