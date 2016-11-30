<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 15.08.2016
 * Time: 6:53
 */

namespace AppBundle\Services\ThirdPartyServices;


class ThirdPartyInformation
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getInformation()
    {
        $url = $this->container->get('app.currency_rate')->getUrl();
        $object = $this->container->get('app.currency_rate');
        $callback = $object->getParseFunction();

        $params = array(
            'object' => $object,
            'callback' => $callback,
            'url' => $url,
        );
        $this->container->get('app.multi_curl')->addTask($params);

        $url = $this->container->get('app.celebrate')->formUrl(new \DateTime());
        $object = $this->container->get('app.celebrate');
        $callback = $object->getParseFunction();

        $params = array(
            'object' => $object,
            'callback' => $callback,
            'url' => $url,
        );

        $this->container->get('app.multi_curl')->addTask($params);

        $url = $this->container->get('app.receive_weather')->getUrl(new \DateTime());
        $object = $this->container->get('app.receive_weather');
        $callback = $object->getParseFunction();

        $params = array(
            'object' => $object,
            'callback' => $callback,
            'url' => $url,
        );
        $this->container->get('app.multi_curl')->addTask($params);

        $this->container->get('app.multi_curl')->execute();
        var_dump('third_party');
    }
}