<?php

namespace AppBundle\Services\ThirdPartyServices;


class Celebrate extends BaseThirdParty{
    protected $url = 'http://www.calend.ru/day/{=date=}/';
    private $dom;
    protected $finder;

    protected $fields = array('celebrate');
    const TYPE = 'celebrate';
    public $type = 'celebrate';

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
            return '';
        }

        libxml_use_internal_errors(true);
        $this->dom->loadHTML($html);
        libxml_use_internal_errors(false);
        $this->finder = new \DOMXPath($this->dom);

        $nodes = $this->finder->query("//div[contains(@class, 'famous-date')]/div/a");
        $result = '';
        if ($nodes->length) {
            $result = trim($nodes->item(0)->textContent);
        }

        $res = array('celebrate' => $result);
        $this->save($res);

        return $res;
    }

    public function formUrl(\DateTime $date)
    {
        return preg_replace('/{=date=}/', $date->format('n-j'), $this->url);
    }

    public function getUrl(\DateTime $date)
    {
        return $this->formUrl($date);
    }
}