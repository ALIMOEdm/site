<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 06.02.2016
 * Time: 19:51
 */

namespace AppBundle\Util;


class NashiNovostiTv  extends Parser{

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
        $this->dom->loadHTML(mb_convert_encoding($html,'HTML-ENTITIES', 'UTF-8'));
        libxml_use_internal_errors(false);

        $this->finder = new \DOMXPath($this->dom);

        $content_node = null;
        $content = $this->getSetOfNodesByXpath(".//div[contains(@class, 'entry-inner')]");
        if(!is_null($content) && $content->length){
            foreach($content as $cont){
                $content_node = $cont;
                break;
            }
        }

        $result = '';
        if(!is_null($content_node)) {
            $this->removeElementByXpath(".//script");
            $this->removeElementByXpath(".//h1");
            $this->removeElementByXpath(".//div[contains(@class,'ssba')]");
            $this->removeElementByXpath(".//div[contains(@class,'sharedaddy')]");
            $result = $this->dom->saveHTML($content_node);
        }
        return $result;

    }
}