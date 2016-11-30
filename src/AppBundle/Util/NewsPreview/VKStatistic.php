<?php
namespace AppBundle\Util\NewsPreview;

class VKStatistic {
    public static function getNewsCnt($url){
        $url = "https://api.vk.com/method/newsfeed.search?q=".$url."&count=200&version=5.37";
            
        $ctx = stream_context_create(array( 
            'http' => array(
                'timeout' => 1 
                ) 
            ) 
        ); 
        
        $res = file_get_contents($url, 0, $ctx);
        
        $result = json_decode($res, true, 512);
        if(!isset($result['response']) || !isset($result['response'][0])){
            return 0;
        }
        
        $res = $result['response'][0];
        return $res;
    }
}
