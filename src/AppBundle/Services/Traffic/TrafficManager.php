<?php
namespace AppBundle\Services\Traffic;

use AppBundle\Entity\Traffic\Route;
use AppBundle\Entity\Traffic\Station;
use AppBundle\Entity\Traffic\Zone;

class TrafficManager
{
    protected $em;
    protected $multiCurl;
    protected $routes = array();
    protected $routesDownloadFinish = false;
    protected $zones = array();
    protected $zonesDownloadFinish = false;
    protected $stations = array();
    protected $stationsDownloadFinish = false;

    public function __construct($em, $multiCurl)
    {
        $this->em = $em;
        $this->multiCurl = $multiCurl;
    }

    public function refreshData()
    {
        $params = array(
            'object' => $this,
            'callback' => 'refreshRoutes',
            'url' => "http://www.traffic22.ru/php/getRoutes.php?city=barnaul&info=12345&_=1474622562033",
        );
        $this->multiCurl->addTask($params);

        $params = array(
            'object' => $this,
            'callback' => 'refreshZones',
            'url' => "http://www.traffic22.ru/php/getZones.php?city=barnaul&info=12345&_=1474622562034",
        );
        $this->multiCurl->addTask($params);

        $params = array(
            'object' => $this,
            'callback' => 'refreshStations',
            'url' => "http://www.traffic22.ru/php/getStations.php?city=barnaul&info=12345&_=1474622562036",
        );
        $this->multiCurl->addTask($params);

        $this->multiCurl->execute();
    }

    public function refreshRoutes($data)
    {
        $parsed_data = json_decode($data, true, 512);

        if (!is_array($parsed_data) || !count($parsed_data)) {
            return;
        }

        $cache = array();
        foreach ($parsed_data as $row) {
            if (in_array($this->getArrayElement($row, 'id'), $cache)) {
                continue;
            }
            $cache[] = $this->getArrayElement($row, 'id');

            $r = $this->getExistenceObject('route', $this->getArrayElement($row, 'id'));
            $r->setDistId($this->getArrayElement($row, 'id'));
            $r->setName($this->getArrayElement($row, 'name'));
            $r->setFromSt($this->getArrayElement($row, 'fromst'));
            $r->setFromStId($this->getArrayElement($row, 'id'));
            $r->setNum($this->getArrayElement($row, 'num'));
            $r->setToSt($this->getArrayElement($row, 'tost'));
            $r->setToStId($this->getArrayElement($row, 'tostid'));
            $r->setType($this->getArrayElement($row, 'type'));
            $this->routes[$r->getDistId()] = $r;
        }
        $this->routesDownloadFinish = true;
        $this->postDownload();
    }

    public function refreshZones($data)
    {
        $parsed_data = json_decode($data, true, 512);

        if (!is_array($parsed_data) || !count($parsed_data)) {
            return;
        }

        $cache = array();
        foreach ($parsed_data as $row) {
            if (in_array($this->getArrayElement($row, 'id'), $cache)) {
                continue;
            }
            $cache[] = $this->getArrayElement($row, 'id');

            $r = $this->getExistenceObject('zone', $this->getArrayElement($row, 'id'));
            $r->setDistId($this->getArrayElement($row, 'id'));
            $r->setName($this->getArrayElement($row, 'name'));
            $r->setCategoryId($this->getArrayElement($row, 'cat_id'));
            $r->setRoutersCache($this->getArrayElement($row, 'routes_ids'));
            $this->zones[] = $r;
        }
        $this->zonesDownloadFinish = true;
        $this->postDownload();
    }

    public function refreshStations($data)
    {
        $parsed_data = json_decode($data, true, 512);

        if (!is_array($parsed_data) || !count($parsed_data)) {
            return;
        }
        $cache = array();
        foreach ($parsed_data as $row) {
            if (in_array($this->getArrayElement($row, 'id'), $cache)) {
                continue;
            }
            $cache[] = $this->getArrayElement($row, 'id');

            $r = $this->getExistenceObject('station', $this->getArrayElement($row, 'id'));
            $r->setDistId($this->getArrayElement($row, 'id'));
            $r->setName($this->getArrayElement($row, 'name'));
            $r->setStationType($this->getArrayElement($row, 'type'));
            $r->setDescription($this->getArrayElement($row, 'descr'));
            $r->setCLat($this->getArrayElement($row, 'lat'));
            $r->setCLong($this->getArrayElement($row, 'lng'));
            $this->stations[] = $r;
        }
        $this->stationsDownloadFinish = true;
        $this->postDownload();
    }

    /**
     * Get element of array by key
     *
     * @param $arr
     * @param $key
     * @return string
     */
    public function getArrayElement($arr, $key)
    {
        if (!is_array($arr)) {
            return '';
        }
        return isset($arr[$key]) ? $arr[$key] : '';
    }

    /**
     * This function will execute after download information
     */
    public function postDownload()
    {
        if (!$this->zonesDownloadFinish || !$this->routesDownloadFinish || !$this->stationsDownloadFinish) {
            return;
        }

        foreach ($this->routes as $route) {
            $this->em->persist($route);
        }

        foreach ($this->zones as $zone) {
            $zone_routes = $zone->getRoutersCache();
            $zone->removeAllRoutes();
            foreach ($zone_routes as $zr) {
                $route_id = explode('-', $zr)[0];
                $zone->addRoute($this->routes[$route_id]);
            }
            $this->em->persist($zone);
        }

        foreach ($this->stations as $station) {
            $this->em->persist($station);
        }

        $this->em->flush();
    }

    public function getExistenceObject($type, $dist_id)
    {
        switch ($type) {
            case 'route':
                $obj = $this->em->getRepository('AppBundle:Traffic\Route')->findOneBy(array('distId' => $dist_id));
                if (!$obj) {
                    $obj = new Route();
                }
                return $obj;
                break;
            case 'station':
                $obj = $this->em->getRepository('AppBundle:Traffic\Station')->findOneBy(array('distId' => $dist_id));
                if (!$obj) {
                    $obj = new Station();
                }
                return $obj;
                break;
            case 'zone':
                $obj = $this->em->getRepository('AppBundle:Traffic\Zone')->findOneBy(array('distId' => $dist_id));
                if (!$obj) {
                    $obj = new Zone();
                }
                return $obj;
                break;
        }
        throw new \Exception('Unknow type');
    }
}