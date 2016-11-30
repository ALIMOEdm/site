<?php
namespace AppBundle\Services\MultiCurl;

class MultiCurlWrapper {
    protected $ch = array();
    protected $multiCurl;

    public function __construct()
    {
        $this->multiCurl = curl_multi_init();
    }

    public function addTask(array $params)
    {
        $this->ch[] = array(
            'curl' => curl_init(),
            'object' => $params['object'],
            'callback' => $params['callback'],
        );
        $index = count($this->ch) - 1;
        curl_setopt($this->ch[$index]['curl'], CURLOPT_URL, $params['url']);
        curl_setopt($this->ch[$index]['curl'], CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch[$index]['curl'], CURLOPT_HEADER, false);
        curl_multi_add_handle($this->multiCurl, $this->ch[$index]['curl']);
    }

    public function execute()
    {
        $running = 0;
        do {
            curl_multi_exec($this->multiCurl, $running);
        } while ($running > 0);

        for ($i = 0; $i < count($this->ch); $i++) {
            $results = curl_multi_getcontent($this->ch[$i]['curl']);
            $object = $this->ch[$i]['object'];
            $callback = $this->ch[$i]['callback'];
            $object->$callback($results);
        }

        foreach ($this->ch as $i => $curl) {
            curl_multi_remove_handle($this->multiCurl, $curl['curl']);
        }

        curl_multi_close($this->multiCurl);
        $this->ch = array();

    }

}