<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 07.02.2016
 * Time: 8:58
 */

namespace AppBundle\Util;


class AltapressParser extends Parser{
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
        $content = $this->getSetOfNodesByXpath(".//div[contains(@class, 'article')]/div[contains(@class, 'article-text')]");
        if(!is_null($content) && $content->length){
            foreach($content as $cont){
                $content_node = $cont;
                break;
            }
        }
        else{
            $content = $this->getSetOfNodesByXpath(".//div[contains(@class, 'content_middle')]/div[contains(@class, 'onenews')]");
            if(!is_null($content) && $content->length){
                foreach($content as $cont){
                    $content_node = $cont;
                    break;
                }
            }else{

                $content = $this->getSetOfNodesByXpath(".//div[contains(@class, 'b-story-content')]");
                if(!is_null($content) && $content->length) {
                    foreach ($content as $cont) {
                        $content_node = $cont;
                        break;
                    }
                }
                else{
                    $content = $this->getSetOfNodesByXpath(".//div[contains(@class, 'b-story-content')]");
                    if(!is_null($content) && $content->length){
                        foreach($content as $cont){
                            $content_node = $cont;
                            break;
                        }
                    }else{
                        $content = $this->getSetOfNodesByXpath(".//div[@class='b-story-content']");
                        if(!is_null($content) && $content->length){
                            foreach($content as $cont){
                                $content_node = $cont;
                                break;
                            }
                        }
                    }
                }
            }
        }

        if(!is_null($content_node)){
            $this->removeElementByXpath(".//table[contains(@class,'story_tools')]");
            $this->removeElementByXpath(".//div[contains(@class,'mainpicture')]");
            $this->removeElementByXpath(".//div[contains(@class,'seealso_container')]");
            $this->removeElementByXpath(".//div[contains(@id,'gallery')]");
            $this->removeElementByXpath(".//div[contains(@class,'gallery-container')]");
            $this->removeElementByXpath(".//div[contains(@class,'object-gallery')]");
            $this->removeElementByXpath(".//div[contains(@class,'article-read-also')]");
            $this->removeElementByXpath(".//ul[contains(@class,'authors')]");
            $this->removeElementByXpath(".//script");
            $this->removeElementByXpath(".//h1");
        }


        $result = '';
        if(!is_null($content_node)) {
            $result = $this->dom->saveHTML($content_node);
        }
        return $result;

    }
}