<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 09.04.2016
 * Time: 17:44
 */

namespace AppBundle\Services\ThirdPartyServices;

/**
 * Class CurrencyRate
 * @package AppBundle\Services
 */
class CurrencyRate extends BaseThirdParty
{

    const TYPE = 'rate';
    public $type = 'rate';
    protected $fields = array('USD', 'EUR');

    private $dom;
    protected $finder;

    public function __construct($em)
    {
        parent::__construct($em);
        $this->dom = new \DOMDocument();
    }

    public function getParseFunction()
    {
        return 'parseResponse';
    }

    public function parseResponse($html)
    {
        if(!trim($html)){
            return array();
        }

        libxml_use_internal_errors(true);
        $this->dom->loadXML($html);
        libxml_use_internal_errors(false);

        $tags = $this->dom->getElementsByTagName('CharCode');

        $result = array();
        if($tags){
            for ($i = 0; $i < $tags->length; $i++) {
                if($tags->item($i)->nodeType == 1 && (strtoupper($tags->item($i)->nodeValue) === 'EUR' || strtoupper($tags->item($i)->nodeValue) === 'USD' )){
                    foreach($tags->item($i)->parentNode->childNodes as $ch){
                        if($ch->nodeType == 1 && strtoupper($ch->nodeName) === 'VALUE'){
                            $value = preg_replace('/,/', '.', $ch->nodeValue);
                            $result[strtoupper($tags->item($i)->nodeValue)] =  round($value, 2);
                        }
                    }
                }
            }

        }

        $this->save($result);
        return $result;
    }


    public function getBaseUrl($date_str)
    {
        return 'http://www.cbr.ru/scripts/XML_daily.asp?date_req='.$date_str;
    }

    public function getTodayUrl()
    {
        $date = new \DateTime();
        $date_str = $date->format('d/m/Y');
        return $this->getBaseUrl($date_str);
    }

    public function getUrl()
    {
        return $this->getTodayUrl();
    }
}