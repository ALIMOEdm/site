<?php

namespace AppBundle\Services\ThirdPartyServices;


use Doctrine\ORM\EntityManager;

class Celebrate extends BaseThirdParty
{
    const TYPE = 'celebrate';

    /**
     * @var string
     */
    protected $url = 'http://www.calend.ru/day/{=date=}/';
    /**
     * @var \DOMDocument
     */
    private $dom;
    /**
     * @var \DOMXPath
     */
    protected $finder;

    /**
     * @var array
     */
    protected $fields = array('celebrate');

    /**
     * @var string
     */
    public $type = 'celebrate';

    /**
     * Celebrate constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->dom = new \DOMDocument();
    }

    /**
     * @return string
     */
    public function getParseFunction() : string
    {
        return 'parseResponse';
    }

    /**
     * @param string $html
     * @return array|string
     */
    public function parseResponse(string $html)
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