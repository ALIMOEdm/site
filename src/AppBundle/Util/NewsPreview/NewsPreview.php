<?php
namespace AppBundle\Util\NewsPreview;

class NewsPreview {
    
    public function getPrev($url_search)
    {
        $url_search = preg_replace('/<\/?[^>]*>/', '', $url_search);
        $url_search = urlencode($url_search);
        $url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D'".$url_search."'%20and%20xpath%3D'%2F%2Fhead'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
        $ctx = stream_context_create(array( 
            'http' => array( 
                'timeout' => 1 
                ) 
            ) 
        ); 
        
        $res = file_get_contents($url, 0, $ctx);
        
        $result = json_decode($res, true, 512);

        if(!isset($result['query']) || !isset($result['query']['results']) || !isset($result['query']['results']['head'])){
            return array();
        }

        $arr = $result['query']['results']['head']['meta'];
        $result_return = array();
        foreach ($arr as $k => $v){
            if(isset($v['property']) || isset($v['name'])){
                switch(isset($v['property']) ? $v['property'] : $v['name']){
                    case 'og:title':
                        $result_return['title'] = $v['content'];
                        break;
                    case 'og:description': 
                        $result_return['description'] = $v['content'];
                        break;
                    case 'description': 
                        $result_return['description'] = $v['content'];
                        break;
                    case 'og:image':
                        $result_return['image'] = $v['content'];
                        break;
                }
            }
        }
        if(count($result_return)){
            $result_return['url'] = $url_search;
        }
        return $result_return;
    }
}
