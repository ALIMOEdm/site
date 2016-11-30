<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 09.04.2016
 * Time: 18:36
 */

namespace AppBundle\Services\ThirdPartyServices;

/**
 * Class ReceiveWeather
 * @package AppBundle\Services
 */
class ReceiveWeather extends BaseThirdParty{

    const TYPE = 'rate';
    public $type = 'rate';
    protected $fields = array('temperature', 'wind_speed', 'humidity', 'visibility');

    protected $city = 'Barnaul';
    public function __construct($em)
    {
        parent::__construct($em);
    }
    public function getUrl()
    {
        return 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22'.$this->city.'%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys';
    }

    public function getParseFunction()
    {
        return 'parseResponse';
    }

    /**
     * Get weather for some city
     *
     * @param $resp
     * @return array
     */
    public function parseResponse($resp)
    {
        $res = json_decode($resp, true, 512);
        if(!$res){
            return array();
        }

        if(!isset($res['query']['results'])){
            return array();
        }

        $res = $res['query']['results']['channel'];

        $temperature = $res['item']['condition']['temp'];
        if($res['units']['temperature'] === 'F'){
            $temperature = ($temperature - 32) * 5 / 9;
        }
        $wind_speed = $res['wind']['speed'];
        if($res['units']['speed'] === 'mph'){
            $wind_speed = $wind_speed * 0.44704;
        }

        $humidity = $res['atmosphere']['humidity'];
        $visibility = $res['atmosphere']['visibility'];

        $result = array(
            'temperature' => $temperature,
            'wind_speed' => $wind_speed,
            'humidity' => $humidity,
            'visibility' => $visibility,
        );

        $this->save($result);
        return $result;
    }
}