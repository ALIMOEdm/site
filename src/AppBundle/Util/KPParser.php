<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 06.02.2016
 * Time: 19:51
 */

namespace AppBundle\Util;


class KPParser  extends Parser{

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
        $content = $this->getSetOfNodesByXpath(".//article[contains(@class, 'article')]/div[contains(@class, 'text')]");
        if(!is_null($content) && $content->length){
            foreach($content as $cont){
                $content_node = $cont;
                break;
            }

        }

        $result = '';
        if(!is_null($content_node)) {
            $this->removeElementByXpath(".//script");
            $result = $this->dom->saveHTML($content_node);
        }
        return $result;

    }
}