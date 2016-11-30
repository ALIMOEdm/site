<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 06.02.2016
 * Time: 19:51
 */

namespace AppBundle\Util;


class MyAltay  extends Parser{

    private $dom;
    protected $finder;

    public function __construct(){
        $this->dom = new \DOMDocument();
    }

    public function parse($html){
        if(!trim($html)){
            return '';
        }

        $html = preg_replace('/<p[^>]*><\/p>/', '', $html);
        libxml_use_internal_errors(true);
        $this->dom->loadHTML(mb_convert_encoding($html,'HTML-ENTITIES', 'UTF-8'));
        libxml_use_internal_errors(false);

        $this->finder = new \DOMXPath($this->dom);

        $content_node = null;
        $content = $this->getSetOfNodesByXpath(".//article[contains(@class, 'article')]/div[contains(@class, 'content')]");
        if(!is_null($content) && $content->length){
            foreach($content as $cont){
                $content_node = $cont;
                break;
            }
        }

        $result = '';
        if(!is_null($content_node)) {
            $this->removeElementByXpath(".//script");
            $this->removeElementByXpath(".//div[contains(@class, 'adsense-single')]");
            $this->removeElementByXpath(".//h2[@class='article-read-more-title']/following-sibling::p");
            $this->removeElementByXpath(".//h2[contains(@class, 'article-read-more-title')]");
            $result = $this->dom->saveHTML($content_node);
        }
        return $result;

    }
}