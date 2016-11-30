<?php
namespace AppBundle\Util\NewsPreview;

class FacebookStatis {
    public static function getNewsCnt($url){
        $url = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".$url;
            
        $ctx = stream_context_create(array( 
            'http' => array( 
                'timeout' => 1 
                ) 
            ) 
        ); 
        
        $res = file_get_contents($url, 0, $ctx);
        
        $doc = new \DOMDocument();
        $doc->loadXML($res);
        
        $shares = $doc->getElementsByTagName('share_count');
        foreach ($shares as $share){
            $cnt = $share->nodeValue;
        }
        return (int)$cnt;
    }
}
