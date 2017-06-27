<?php
namespace AppBundle\Util;

class VkRequests {
    public static function getLatestNews($group_id, $count, $offset){
        $url = "https://api.vk.com/method/wall.get?";
        $url .= "owner_id=".$group_id;
        $url .= "&count=".$count;
        $url .= "&filter=owner";
        $url .= "&offset=".$offset;
	$url .= "&access_token=89de93b789de93b7896ea138f1898a51f0889de89de93b7d1138c017cc42cc7dc5534ab";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array (
            "Content-Type: application/json; charset=utf-8"
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $result = json_decode(curl_exec($ch), true, 512);

        return $result;
    }


    public static function getAccessToken(){
        $client_id = 5044133;
        $access_token = 'A93fSJb3BEutqdVMWr4f';
        $url = 'https://oauth.vk.com/access_token?client_id='.$client_id.'&client_secret='.$access_token.'&v=5.45&grant_type=client_credentials';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array (
            "Content-Type: application/json; charset=utf-8"
        ));

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $result = json_decode(curl_exec($ch), true, 512);

        return $result;
    }

    public static function postMessage(){
        $client_id = 5044133;
        $access_token = 'A93fSJb3BEutqdVMWr4f';
        $url = 'https://oauth.vk.com/access_token?client_id='.$client_id.'&client_secret='.$access_token.'&v=5.45&grant_type=client_credentials';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array (
            "Content-Type: application/json; charset=utf-8"
        ));

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $result = json_decode(curl_exec($ch), true, 512);

        return $result;
    }
}
