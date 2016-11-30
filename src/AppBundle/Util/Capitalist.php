<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 06.02.2016
 * Time: 19:51
 */

namespace AppBundle\Util;


class Capitalist  extends Parser{

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
        $content = $this->getSetOfNodesByXpath(".//div[contains(@class, 'shortcode-content')]");
        if(!is_null($content) && $content->length){
            foreach($content as $cont){
                $content_node = $cont;
                break;
            }

            $this->removeElementByXpath(".//div[contains(@class,'article-header')]");
            $this->removeElementByXpath(".//div[contains(@class,'about-author')]");
            $this->removeElementByXpath(".//div[contains(@class,'tags-cats')]");
            $this->removeElementByXpath(".//div[contains(@class,'ya-share2')]");
            $this->removeElementByXpath(".//script");
        }

        $result = '';
        if(!is_null($content_node)) {
            $this->removeElementByXpath(".//script");
            $result = $this->dom->saveHTML($content_node);
        }
        return $result;

    }
}