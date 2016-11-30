<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 06.02.2016
 * Time: 19:51
 */

namespace AppBundle\Util;


class Ap22  extends Parser{

    private $dom;
    protected $finder;

    public function __construct(){
        $this->dom = new \DOMDocument();
    }

    public function parse($html){
        if(!trim($html)){
            return '';
        }

        $html = preg_replace('/col-[a-z]{2,}-[1-9]{1,2}/', '', $html);
        libxml_use_internal_errors(true);
        $this->dom->loadHTML($html);
        libxml_use_internal_errors(false);

        $this->finder = new \DOMXPath($this->dom);

        $content_node = null;
        $content = $this->getSetOfNodesByXpath(".//section[contains(@class, 'full')]");
        if(!is_null($content) && $content->length){
            foreach($content as $cont){
                $content_node = $cont;
                break;
            }
        }else{
            $content = $this->getSetOfNodesByXpath(".//div[contains(@class, 'full')]");
            if(!is_null($content) && count($content)){
                foreach($content as $cont){
                    $content_node = $cont;
                    break;
                }
            }
        }

        $result = '';
        if(!is_null($content_node)) {
            $this->removeElementByXpath(".//script");
            $this->removeElementByXpath(".//h1");
            $this->removeElementByXpath(".//div[contains(@class,'line')]");
            $this->removeElementByXpath(".//div[contains(@class,'time')]");
            $this->removeElementByXpath(".//span[contains(@class,'nonPrint')]");
            $this->removeElementByXpath(".//div[contains(@class,'news-block-magick')]");
            $this->removeElementByXpath(".//div[contains(@class,'section')]");
            $result = $this->dom->saveHTML($content_node);
        }
        return $result;

    }
}