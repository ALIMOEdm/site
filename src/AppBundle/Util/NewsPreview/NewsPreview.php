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
//        var_dump($result);
        if(!isset($result['query']) || !isset($result['query']['results']) || !isset($result['query']['results']['head'])){
            return array();
        }
        $arr = $result['query']['results']['head']['meta'];
//        var_dump($arr);
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
    
    public function getTokeb($url_search){

        
//        $url_search = urlencode($url_search);
//        $url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D'".$url_search."'%20and%20xpath%3D'%2F%2Fhead'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
//        $key = base64_encode(urlencode('jn4uiBVyTR1r4kFTgZhArD8sf').':'.urlencode('JfAzc2nZ61GHzktutMFzc2yDSKYIZEKNBcJK9EbSNB0PjrFW7V'));
//        $ch = curl_init();
//        var_dump($url_search);
//        curl_setopt($ch, CURLOPT_URL, $url_search);
//        curl_setopt($ch, CURLOPT_HEADER, false);
//        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
//        $resp = iconv('CP1251', 'UTF-8', curl_exec($ch));
//        curl_close($ch);
//        var_dump($resp);
        
        
        $accept = array(
    'type' => array('application/rss+xml', 'application/xml', 'application/rdf+xml', 'text/xml'),
    'charset' => array_diff(mb_list_encodings(), array('pass', 'auto', 'wchar', 'byte2be', 'byte2le', 'byte4be', 'byte4le', 'BASE64', 'UUENCODE', 'HTML-ENTITIES', 'Quoted-Printable', '7bit', '8bit'))
);
$header = array(
    'Accept: '.implode(', ', $accept['type']),
    'Accept-Charset: '.implode(', ', $accept['charset']),
);
$encoding = null;
$curl = curl_init($url_search);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
//$response = curl_exec($curl);
mb_http_output('UTF-8');
mb_http_input('UTF-8');
    
    $response = curl_exec($curl);
    var_dump($response);
$body = mb_convert_encoding($response, 'utf-8', mb_http_input("G"));
    var_dump($response);

        
        
//        $doc = new \DOMDocument();
//    $doc->loadHTML($resp);
////        $xpath = new \DomXpath($doc);
////        var_dump($document->query())
//        
//        $metas = $doc->getElementsByTagName('meta');
//        var_dump($doc);
////        foreach($xpath->query('//meta') as $meta){
////            var_dump($meta->getAttribute('content'));
////        }
//        foreach($metas as $meta){
//            var_dump($meta->getAttribute('content'));
//        }
    }
}
