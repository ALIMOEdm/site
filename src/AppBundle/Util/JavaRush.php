<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 07.02.2016
 * Time: 8:58
 */

namespace AppBundle\Util;


class JavaRush extends Parser{
    private $dom;
    protected $finder;

    public function __construct(){
        $this->dom = new \DOMDocument();
    }

    public function parse($html){
        if(!trim($html)){
            return '';
        }

        libxml_use_internal_errors(true);
        $this->dom->loadHTML($html);
        libxml_use_internal_errors(false);

        $this->finder = new \DOMXPath($this->dom);

        $content_node = null;
        $content = $this->getSetOfNodesByXpath(".//body");
        if(!is_null($content) && count($content)){
            foreach($content as $cont){
                $content_node = $cont;
                break;
            }
        }


        if(!is_null($content_node)){
            $this->removeElementByXpath(".//header[@class='main-header']");
            $this->removeElementByXpath(".//footer[@class='main-footer']");
            $this->removeElementByXpath(".//body/section[last()]");
            $this->removeElementByXpath(".//body/section[last()]");
            $this->removeElementByXpath(".//script");
        }


        $result = '';
        if(!is_null($content_node)) {
            $result = $this->dom->saveHTML($content_node);
        }
        return $result;

    }

}