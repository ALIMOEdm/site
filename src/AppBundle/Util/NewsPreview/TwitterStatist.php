<?php
namespace AppBundle\Util\NewsPreview;

class TwitterStatist {
    private static $token = '';
    
    protected static function getTokeb(){
        if(self::$token){
            return self::$token;
        }
        $key = base64_encode(urlencode('jn4uiBVyTR1r4kFTgZhArD8sf').':'.urlencode('JfAzc2nZ61GHzktutMFzc2yDSKYIZEKNBcJK9EbSNB0PjrFW7V'));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.twitter.com/oauth2/token');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic '.$key,
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8'
            ));
        $data = array('grant_type' => 'client_credentials');
        $post_data = 'grant_type=client_credentials';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($ch);
        curl_close($ch);
        
        $result = json_decode($resp, true, 512);
        if(is_null($result) || !isset($result['access_token'])){
            return 0;
        }
        
        $token = $result['access_token'];
        self::$token = $token;
        return $token;
    }

    public static function getNewsCnt($url){
        
        $token = self::getTokeb();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.twitter.com/1.1/search/tweets.json?q='.$url.'&result_type=recent');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: bearer '.$token,
            ));
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($ch);
        curl_close($ch);
        
        $result = json_decode($resp, true, 512);
        if(is_null($result) || !isset($result['statuses'])){
            return 0;
        }
        
        return count($result['statuses']);

    }
}
/*
array (
  'statuses' => 
  array (
    0 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 11:06:24 +0000 2015',
      'id' => 641205942101651456,
      'id_str' => '641205942101651456',
      'text' => 'RT @SobolLubov: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com/download/android" rel="nofollow">Twitter for Android</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 187856813,
        'id_str' => '187856813',
        'name' => 'Трэш и угар',
        'screen_name' => 'djdr0n',
        'location' => '',
        'description' => '',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 194,
        'friends_count' => 161,
        'listed_count' => 8,
        'created_at' => 'Tue Sep 07 10:04:31 +0000 2010',
        'favourites_count' => 48274,
        'utc_offset' => 10800,
        'time_zone' => 'Kyiv',
        'geo_enabled' => false,
        'verified' => false,
        'statuses_count' => 54217,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'B2DFDA',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme13/bg.gif',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme13/bg.gif',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/1208225404/dj_avatar_normal.png',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/1208225404/dj_avatar_normal.png',
        'profile_link_color' => '93A644',
        'profile_sidebar_border_color' => 'EEEEEE',
        'profile_sidebar_fill_color' => 'FFFFFF',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => false,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
        'id' => 641194039551856645,
        'id_str' => '641194039551856645',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 257690350,
          'id_str' => '257690350',
          'name' => 'Соболь Любовь',
          'screen_name' => 'SobolLubov',
          'location' => '',
          'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
          'url' => 'http://t.co/OXcanjDiR7',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/OXcanjDiR7',
                  'expanded_url' => 'http://sobollubov.ru',
                  'display_url' => 'sobollubov.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 51743,
          'friends_count' => 480,
          'listed_count' => 516,
          'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
          'favourites_count' => 1431,
          'utc_offset' => -18000,
          'time_zone' => 'Central Time (US & Canada)',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 31793,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => 'C0DEED',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
          'profile_link_color' => '0084B4',
          'profile_sidebar_border_color' => 'C0DEED',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => true,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 9,
        'favorite_count' => 3,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/BqakH4Umrq',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
          'media' => 
          array (
            0 => 
            array (
              'id' => 641194037760823296,
              'id_str' => '641194037760823296',
              'indices' => 
              array (
                0 => 87,
                1 => 109,
              ),
              'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'url' => 'http://t.co/QKNDDwcwzW',
              'display_url' => 'pic.twitter.com/QKNDDwcwzW',
              'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
              'type' => 'photo',
              'sizes' => 
              array (
                'medium' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
                'small' => 
                array (
                  'w' => 340,
                  'h' => 86,
                  'resize' => 'fit',
                ),
                'thumb' => 
                array (
                  'w' => 150,
                  'h' => 150,
                  'resize' => 'crop',
                ),
                'large' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'SobolLubov',
            'name' => 'Соболь Любовь',
            'id' => 257690350,
            'id_str' => '257690350',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 103,
              1 => 125,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
            'source_status_id' => 641194039551856645,
            'source_status_id_str' => '641194039551856645',
            'source_user_id' => 257690350,
            'source_user_id_str' => '257690350',
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    1 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 10:44:02 +0000 2015',
      'id' => 641200312636846081,
      'id_str' => '641200312636846081',
      'text' => 'RT @SobolLubov: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com/download/iphone" rel="nofollow">Twitter for iPhone</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 1579743306,
        'id_str' => '1579743306',
        'name' => 'Волкова Надежда',
        'screen_name' => 'VolkonaVT',
        'location' => 'Москва',
        'description' => 'Люблю свою семью, друзей, животных',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 2661,
        'friends_count' => 2824,
        'listed_count' => 62,
        'created_at' => 'Tue Jul 09 08:10:14 +0000 2013',
        'favourites_count' => 25402,
        'utc_offset' => 14400,
        'time_zone' => 'Abu Dhabi',
        'geo_enabled' => true,
        'verified' => false,
        'statuses_count' => 73000,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/589563623560839168/VXQSXHQn_normal.jpg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/589563623560839168/VXQSXHQn_normal.jpg',
        'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/1579743306/1416491344',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
        'id' => 641194039551856645,
        'id_str' => '641194039551856645',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 257690350,
          'id_str' => '257690350',
          'name' => 'Соболь Любовь',
          'screen_name' => 'SobolLubov',
          'location' => '',
          'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
          'url' => 'http://t.co/OXcanjDiR7',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/OXcanjDiR7',
                  'expanded_url' => 'http://sobollubov.ru',
                  'display_url' => 'sobollubov.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 51743,
          'friends_count' => 480,
          'listed_count' => 516,
          'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
          'favourites_count' => 1431,
          'utc_offset' => -18000,
          'time_zone' => 'Central Time (US & Canada)',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 31793,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => 'C0DEED',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
          'profile_link_color' => '0084B4',
          'profile_sidebar_border_color' => 'C0DEED',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => true,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 9,
        'favorite_count' => 3,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/BqakH4Umrq',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
          'media' => 
          array (
            0 => 
            array (
              'id' => 641194037760823296,
              'id_str' => '641194037760823296',
              'indices' => 
              array (
                0 => 87,
                1 => 109,
              ),
              'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'url' => 'http://t.co/QKNDDwcwzW',
              'display_url' => 'pic.twitter.com/QKNDDwcwzW',
              'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
              'type' => 'photo',
              'sizes' => 
              array (
                'medium' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
                'small' => 
                array (
                  'w' => 340,
                  'h' => 86,
                  'resize' => 'fit',
                ),
                'thumb' => 
                array (
                  'w' => 150,
                  'h' => 150,
                  'resize' => 'crop',
                ),
                'large' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'SobolLubov',
            'name' => 'Соболь Любовь',
            'id' => 257690350,
            'id_str' => '257690350',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 103,
              1 => 125,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
            'source_status_id' => 641194039551856645,
            'source_status_id_str' => '641194039551856645',
            'source_user_id' => 257690350,
            'source_user_id_str' => '257690350',
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    2 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 10:29:01 +0000 2015',
      'id' => 641196536672686080,
      'id_str' => '641196536672686080',
      'text' => 'RT @SobolLubov: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com/download/iphone" rel="nofollow">Twitter for iPhone</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 1400564005,
        'id_str' => '1400564005',
        'name' => 'Виктория Ретынская',
        'screen_name' => 'Retynskaya24',
        'location' => '',
        'description' => 'Самое главное о главном. Ничего личного.',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 109,
        'friends_count' => 56,
        'listed_count' => 1,
        'created_at' => 'Fri May 03 19:34:15 +0000 2013',
        'favourites_count' => 547,
        'utc_offset' => NULL,
        'time_zone' => NULL,
        'geo_enabled' => true,
        'verified' => false,
        'statuses_count' => 4663,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/623256947408683008/MEwSLG8B_normal.jpg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/623256947408683008/MEwSLG8B_normal.jpg',
        'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/1400564005/1367611946',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
        'id' => 641194039551856645,
        'id_str' => '641194039551856645',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 257690350,
          'id_str' => '257690350',
          'name' => 'Соболь Любовь',
          'screen_name' => 'SobolLubov',
          'location' => '',
          'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
          'url' => 'http://t.co/OXcanjDiR7',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/OXcanjDiR7',
                  'expanded_url' => 'http://sobollubov.ru',
                  'display_url' => 'sobollubov.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 51743,
          'friends_count' => 480,
          'listed_count' => 516,
          'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
          'favourites_count' => 1431,
          'utc_offset' => -18000,
          'time_zone' => 'Central Time (US & Canada)',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 31793,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => 'C0DEED',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
          'profile_link_color' => '0084B4',
          'profile_sidebar_border_color' => 'C0DEED',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => true,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 9,
        'favorite_count' => 3,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/BqakH4Umrq',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
          'media' => 
          array (
            0 => 
            array (
              'id' => 641194037760823296,
              'id_str' => '641194037760823296',
              'indices' => 
              array (
                0 => 87,
                1 => 109,
              ),
              'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'url' => 'http://t.co/QKNDDwcwzW',
              'display_url' => 'pic.twitter.com/QKNDDwcwzW',
              'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
              'type' => 'photo',
              'sizes' => 
              array (
                'medium' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
                'small' => 
                array (
                  'w' => 340,
                  'h' => 86,
                  'resize' => 'fit',
                ),
                'thumb' => 
                array (
                  'w' => 150,
                  'h' => 150,
                  'resize' => 'crop',
                ),
                'large' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'SobolLubov',
            'name' => 'Соболь Любовь',
            'id' => 257690350,
            'id_str' => '257690350',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 103,
              1 => 125,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
            'source_status_id' => 641194039551856645,
            'source_status_id_str' => '641194039551856645',
            'source_user_id' => 257690350,
            'source_user_id_str' => '257690350',
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    3 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 10:28:44 +0000 2015',
      'id' => 641196464207736832,
      'id_str' => '641196464207736832',
      'text' => 'RT @SobolLubov: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 610966328,
        'id_str' => '610966328',
        'name' => 'Андрей',
        'screen_name' => 'Freedsav',
        'location' => 'Москва',
        'description' => 'Тестирую выживаемость малого бизнеса в текущих условиях страны. Социалист. Блогер. Разрушитель мозга туристов Селигера.',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 403,
        'friends_count' => 411,
        'listed_count' => 23,
        'created_at' => 'Sun Jun 17 17:10:54 +0000 2012',
        'favourites_count' => 640,
        'utc_offset' => 10800,
        'time_zone' => 'Moscow',
        'geo_enabled' => true,
        'verified' => false,
        'statuses_count' => 29785,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'E4EBEB',
        'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/581447158/djbe0mwq743wmiszwq53.png',
        'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/581447158/djbe0mwq743wmiszwq53.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/467252411447271424/cy_GgpDz_normal.png',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/467252411447271424/cy_GgpDz_normal.png',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => false,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
        'id' => 641194039551856645,
        'id_str' => '641194039551856645',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 257690350,
          'id_str' => '257690350',
          'name' => 'Соболь Любовь',
          'screen_name' => 'SobolLubov',
          'location' => '',
          'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
          'url' => 'http://t.co/OXcanjDiR7',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/OXcanjDiR7',
                  'expanded_url' => 'http://sobollubov.ru',
                  'display_url' => 'sobollubov.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 51743,
          'friends_count' => 480,
          'listed_count' => 516,
          'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
          'favourites_count' => 1431,
          'utc_offset' => -18000,
          'time_zone' => 'Central Time (US & Canada)',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 31793,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => 'C0DEED',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
          'profile_link_color' => '0084B4',
          'profile_sidebar_border_color' => 'C0DEED',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => true,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 9,
        'favorite_count' => 3,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/BqakH4Umrq',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
          'media' => 
          array (
            0 => 
            array (
              'id' => 641194037760823296,
              'id_str' => '641194037760823296',
              'indices' => 
              array (
                0 => 87,
                1 => 109,
              ),
              'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'url' => 'http://t.co/QKNDDwcwzW',
              'display_url' => 'pic.twitter.com/QKNDDwcwzW',
              'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
              'type' => 'photo',
              'sizes' => 
              array (
                'medium' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
                'small' => 
                array (
                  'w' => 340,
                  'h' => 86,
                  'resize' => 'fit',
                ),
                'thumb' => 
                array (
                  'w' => 150,
                  'h' => 150,
                  'resize' => 'crop',
                ),
                'large' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'SobolLubov',
            'name' => 'Соболь Любовь',
            'id' => 257690350,
            'id_str' => '257690350',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 103,
              1 => 125,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
            'source_status_id' => 641194039551856645,
            'source_status_id_str' => '641194039551856645',
            'source_user_id' => 257690350,
            'source_user_id_str' => '257690350',
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    4 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 10:27:01 +0000 2015',
      'id' => 641196031204564992,
      'id_str' => '641196031204564992',
      'text' => 'RT @SobolLubov: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com/download/iphone" rel="nofollow">Twitter for iPhone</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 1667210599,
        'id_str' => '1667210599',
        'name' => 'jyppo',
        'screen_name' => 'jypposever',
        'location' => '',
        'description' => '',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 194,
        'friends_count' => 284,
        'listed_count' => 8,
        'created_at' => 'Tue Aug 13 08:11:53 +0000 2013',
        'favourites_count' => 623,
        'utc_offset' => NULL,
        'time_zone' => NULL,
        'geo_enabled' => true,
        'verified' => false,
        'statuses_count' => 25461,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/428452785500483584/mBm1uduP_normal.jpeg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/428452785500483584/mBm1uduP_normal.jpeg',
        'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/1667210599/1425210832',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
        'id' => 641194039551856645,
        'id_str' => '641194039551856645',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 257690350,
          'id_str' => '257690350',
          'name' => 'Соболь Любовь',
          'screen_name' => 'SobolLubov',
          'location' => '',
          'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
          'url' => 'http://t.co/OXcanjDiR7',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/OXcanjDiR7',
                  'expanded_url' => 'http://sobollubov.ru',
                  'display_url' => 'sobollubov.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 51743,
          'friends_count' => 480,
          'listed_count' => 516,
          'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
          'favourites_count' => 1431,
          'utc_offset' => -18000,
          'time_zone' => 'Central Time (US & Canada)',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 31793,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => 'C0DEED',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
          'profile_link_color' => '0084B4',
          'profile_sidebar_border_color' => 'C0DEED',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => true,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 9,
        'favorite_count' => 3,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/BqakH4Umrq',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
          'media' => 
          array (
            0 => 
            array (
              'id' => 641194037760823296,
              'id_str' => '641194037760823296',
              'indices' => 
              array (
                0 => 87,
                1 => 109,
              ),
              'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'url' => 'http://t.co/QKNDDwcwzW',
              'display_url' => 'pic.twitter.com/QKNDDwcwzW',
              'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
              'type' => 'photo',
              'sizes' => 
              array (
                'medium' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
                'small' => 
                array (
                  'w' => 340,
                  'h' => 86,
                  'resize' => 'fit',
                ),
                'thumb' => 
                array (
                  'w' => 150,
                  'h' => 150,
                  'resize' => 'crop',
                ),
                'large' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'SobolLubov',
            'name' => 'Соболь Любовь',
            'id' => 257690350,
            'id_str' => '257690350',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 103,
              1 => 125,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
            'source_status_id' => 641194039551856645,
            'source_status_id_str' => '641194039551856645',
            'source_user_id' => 257690350,
            'source_user_id_str' => '257690350',
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    5 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 10:25:29 +0000 2015',
      'id' => 641195646293291008,
      'id_str' => '641195646293291008',
      'text' => 'RT @SobolLubov: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 575353502,
        'id_str' => '575353502',
        'name' => 'Krakozyabr',
        'screen_name' => 'Ne_Ochkyi',
        'location' => '',
        'description' => '',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 16,
        'friends_count' => 10,
        'listed_count' => 0,
        'created_at' => 'Wed May 09 13:28:41 +0000 2012',
        'favourites_count' => 104,
        'utc_offset' => NULL,
        'time_zone' => NULL,
        'geo_enabled' => false,
        'verified' => false,
        'statuses_count' => 3528,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://abs.twimg.com/sticky/default_profile_images/default_profile_3_normal.png',
        'profile_image_url_https' => 'https://abs.twimg.com/sticky/default_profile_images/default_profile_3_normal.png',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => true,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
        'id' => 641194039551856645,
        'id_str' => '641194039551856645',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 257690350,
          'id_str' => '257690350',
          'name' => 'Соболь Любовь',
          'screen_name' => 'SobolLubov',
          'location' => '',
          'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
          'url' => 'http://t.co/OXcanjDiR7',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/OXcanjDiR7',
                  'expanded_url' => 'http://sobollubov.ru',
                  'display_url' => 'sobollubov.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 51743,
          'friends_count' => 480,
          'listed_count' => 516,
          'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
          'favourites_count' => 1431,
          'utc_offset' => -18000,
          'time_zone' => 'Central Time (US & Canada)',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 31793,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => 'C0DEED',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
          'profile_link_color' => '0084B4',
          'profile_sidebar_border_color' => 'C0DEED',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => true,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 9,
        'favorite_count' => 3,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/BqakH4Umrq',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
          'media' => 
          array (
            0 => 
            array (
              'id' => 641194037760823296,
              'id_str' => '641194037760823296',
              'indices' => 
              array (
                0 => 87,
                1 => 109,
              ),
              'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'url' => 'http://t.co/QKNDDwcwzW',
              'display_url' => 'pic.twitter.com/QKNDDwcwzW',
              'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
              'type' => 'photo',
              'sizes' => 
              array (
                'medium' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
                'small' => 
                array (
                  'w' => 340,
                  'h' => 86,
                  'resize' => 'fit',
                ),
                'thumb' => 
                array (
                  'w' => 150,
                  'h' => 150,
                  'resize' => 'crop',
                ),
                'large' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'SobolLubov',
            'name' => 'Соболь Любовь',
            'id' => 257690350,
            'id_str' => '257690350',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 103,
              1 => 125,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
            'source_status_id' => 641194039551856645,
            'source_status_id_str' => '641194039551856645',
            'source_user_id' => 257690350,
            'source_user_id_str' => '257690350',
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    6 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 10:25:07 +0000 2015',
      'id' => 641195553712377856,
      'id_str' => '641195553712377856',
      'text' => 'RT @SobolLubov: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 2469254084,
        'id_str' => '2469254084',
        'name' => 'Епифанцева Оленька',
        'screen_name' => 'EpifantzevaOle',
        'location' => '',
        'description' => '',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 14,
        'friends_count' => 127,
        'listed_count' => 0,
        'created_at' => 'Tue Apr 29 12:59:20 +0000 2014',
        'favourites_count' => 0,
        'utc_offset' => NULL,
        'time_zone' => NULL,
        'geo_enabled' => false,
        'verified' => false,
        'statuses_count' => 197,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => true,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/461487036700975104/ndLfsM_w_normal.jpeg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/461487036700975104/ndLfsM_w_normal.jpeg',
        'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/2469254084/1398962334',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
        'id' => 641194039551856645,
        'id_str' => '641194039551856645',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 257690350,
          'id_str' => '257690350',
          'name' => 'Соболь Любовь',
          'screen_name' => 'SobolLubov',
          'location' => '',
          'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
          'url' => 'http://t.co/OXcanjDiR7',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/OXcanjDiR7',
                  'expanded_url' => 'http://sobollubov.ru',
                  'display_url' => 'sobollubov.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 51743,
          'friends_count' => 480,
          'listed_count' => 516,
          'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
          'favourites_count' => 1431,
          'utc_offset' => -18000,
          'time_zone' => 'Central Time (US & Canada)',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 31793,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => 'C0DEED',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
          'profile_link_color' => '0084B4',
          'profile_sidebar_border_color' => 'C0DEED',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => true,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 9,
        'favorite_count' => 3,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/BqakH4Umrq',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
          'media' => 
          array (
            0 => 
            array (
              'id' => 641194037760823296,
              'id_str' => '641194037760823296',
              'indices' => 
              array (
                0 => 87,
                1 => 109,
              ),
              'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'url' => 'http://t.co/QKNDDwcwzW',
              'display_url' => 'pic.twitter.com/QKNDDwcwzW',
              'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
              'type' => 'photo',
              'sizes' => 
              array (
                'medium' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
                'small' => 
                array (
                  'w' => 340,
                  'h' => 86,
                  'resize' => 'fit',
                ),
                'thumb' => 
                array (
                  'w' => 150,
                  'h' => 150,
                  'resize' => 'crop',
                ),
                'large' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'SobolLubov',
            'name' => 'Соболь Любовь',
            'id' => 257690350,
            'id_str' => '257690350',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 103,
              1 => 125,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
            'source_status_id' => 641194039551856645,
            'source_status_id_str' => '641194039551856645',
            'source_user_id' => 257690350,
            'source_user_id_str' => '257690350',
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    7 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 10:20:51 +0000 2015',
      'id' => 641194478334812160,
      'id_str' => '641194478334812160',
      'text' => 'RT @SobolLubov: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 802052994,
        'id_str' => '802052994',
        'name' => 'Алексей Крылов',
        'screen_name' => 'zelenodolskaya',
        'location' => '',
        'description' => '',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 263,
        'friends_count' => 115,
        'listed_count' => 2,
        'created_at' => 'Tue Sep 04 08:37:42 +0000 2012',
        'favourites_count' => 44,
        'utc_offset' => NULL,
        'time_zone' => NULL,
        'geo_enabled' => false,
        'verified' => false,
        'statuses_count' => 23784,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/509032980200054784/QCt75VN5_normal.jpeg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/509032980200054784/QCt75VN5_normal.jpeg',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
        'id' => 641194039551856645,
        'id_str' => '641194039551856645',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 257690350,
          'id_str' => '257690350',
          'name' => 'Соболь Любовь',
          'screen_name' => 'SobolLubov',
          'location' => '',
          'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
          'url' => 'http://t.co/OXcanjDiR7',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/OXcanjDiR7',
                  'expanded_url' => 'http://sobollubov.ru',
                  'display_url' => 'sobollubov.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 51743,
          'friends_count' => 480,
          'listed_count' => 516,
          'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
          'favourites_count' => 1431,
          'utc_offset' => -18000,
          'time_zone' => 'Central Time (US & Canada)',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 31793,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => 'C0DEED',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
          'profile_link_color' => '0084B4',
          'profile_sidebar_border_color' => 'C0DEED',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => true,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 9,
        'favorite_count' => 3,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/BqakH4Umrq',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
          'media' => 
          array (
            0 => 
            array (
              'id' => 641194037760823296,
              'id_str' => '641194037760823296',
              'indices' => 
              array (
                0 => 87,
                1 => 109,
              ),
              'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'url' => 'http://t.co/QKNDDwcwzW',
              'display_url' => 'pic.twitter.com/QKNDDwcwzW',
              'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
              'type' => 'photo',
              'sizes' => 
              array (
                'medium' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
                'small' => 
                array (
                  'w' => 340,
                  'h' => 86,
                  'resize' => 'fit',
                ),
                'thumb' => 
                array (
                  'w' => 150,
                  'h' => 150,
                  'resize' => 'crop',
                ),
                'large' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'SobolLubov',
            'name' => 'Соболь Любовь',
            'id' => 257690350,
            'id_str' => '257690350',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 103,
              1 => 125,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
            'source_status_id' => 641194039551856645,
            'source_status_id_str' => '641194039551856645',
            'source_user_id' => 257690350,
            'source_user_id_str' => '257690350',
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    8 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 10:20:33 +0000 2015',
      'id' => 641194404913541120,
      'id_str' => '641194404913541120',
      'text' => 'RT @SobolLubov: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 1323229969,
        'id_str' => '1323229969',
        'name' => 'Ольга Плахутина',
        'screen_name' => 'plaxog',
        'location' => 'Краснодар',
        'description' => 'мало не делать ничего плохого, нужно делать что-то хорошее',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 404,
        'friends_count' => 257,
        'listed_count' => 12,
        'created_at' => 'Tue Apr 02 20:29:04 +0000 2013',
        'favourites_count' => 410,
        'utc_offset' => NULL,
        'time_zone' => NULL,
        'geo_enabled' => true,
        'verified' => false,
        'statuses_count' => 4892,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'B2DFDA',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme13/bg.gif',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme13/bg.gif',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/466948377339756545/oRQE6_3t_normal.jpeg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/466948377339756545/oRQE6_3t_normal.jpeg',
        'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/1323229969/1411652689',
        'profile_link_color' => '93A644',
        'profile_sidebar_border_color' => 'EEEEEE',
        'profile_sidebar_fill_color' => 'FFFFFF',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => false,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
        'id' => 641194039551856645,
        'id_str' => '641194039551856645',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 257690350,
          'id_str' => '257690350',
          'name' => 'Соболь Любовь',
          'screen_name' => 'SobolLubov',
          'location' => '',
          'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
          'url' => 'http://t.co/OXcanjDiR7',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/OXcanjDiR7',
                  'expanded_url' => 'http://sobollubov.ru',
                  'display_url' => 'sobollubov.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 51743,
          'friends_count' => 480,
          'listed_count' => 516,
          'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
          'favourites_count' => 1431,
          'utc_offset' => -18000,
          'time_zone' => 'Central Time (US & Canada)',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 31793,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => 'C0DEED',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
          'profile_link_color' => '0084B4',
          'profile_sidebar_border_color' => 'C0DEED',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => true,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 9,
        'favorite_count' => 3,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/BqakH4Umrq',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
          'media' => 
          array (
            0 => 
            array (
              'id' => 641194037760823296,
              'id_str' => '641194037760823296',
              'indices' => 
              array (
                0 => 87,
                1 => 109,
              ),
              'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
              'url' => 'http://t.co/QKNDDwcwzW',
              'display_url' => 'pic.twitter.com/QKNDDwcwzW',
              'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
              'type' => 'photo',
              'sizes' => 
              array (
                'medium' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
                'small' => 
                array (
                  'w' => 340,
                  'h' => 86,
                  'resize' => 'fit',
                ),
                'thumb' => 
                array (
                  'w' => 150,
                  'h' => 150,
                  'resize' => 'crop',
                ),
                'large' => 
                array (
                  'w' => 593,
                  'h' => 150,
                  'resize' => 'fit',
                ),
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'SobolLubov',
            'name' => 'Соболь Любовь',
            'id' => 257690350,
            'id_str' => '257690350',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 103,
              1 => 125,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
            'source_status_id' => 641194039551856645,
            'source_status_id_str' => '641194039551856645',
            'source_user_id' => 257690350,
            'source_user_id_str' => '257690350',
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    9 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 10:19:06 +0000 2015',
      'id' => 641194039551856645,
      'id_str' => '641194039551856645',
      'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/BqakH4Umrq http://t.co/QKNDDwcwzW',
      'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 257690350,
        'id_str' => '257690350',
        'name' => 'Соболь Любовь',
        'screen_name' => 'SobolLubov',
        'location' => '',
        'description' => 'Юрист Фонда борьбы с коррупцией, проект РосПил. Член Центрального Совета Партии прогресса',
        'url' => 'http://t.co/OXcanjDiR7',
        'entities' => 
        array (
          'url' => 
          array (
            'urls' => 
            array (
              0 => 
              array (
                'url' => 'http://t.co/OXcanjDiR7',
                'expanded_url' => 'http://sobollubov.ru',
                'display_url' => 'sobollubov.ru',
                'indices' => 
                array (
                  0 => 0,
                  1 => 22,
                ),
              ),
            ),
          ),
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 51743,
        'friends_count' => 480,
        'listed_count' => 516,
        'created_at' => 'Fri Feb 25 23:52:28 +0000 2011',
        'favourites_count' => 1431,
        'utc_offset' => -18000,
        'time_zone' => 'Central Time (US & Canada)',
        'geo_enabled' => true,
        'verified' => true,
        'statuses_count' => 31793,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
        'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/451368752/1DoZG.png',
        'profile_background_tile' => true,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3239289873/1fc386b5f18fe5e8f5a98c95b612b7a1_normal.jpeg',
        'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/257690350/1438266421',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => false,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'is_quote_status' => false,
      'retweet_count' => 9,
      'favorite_count' => 3,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BqakH4Umrq',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 64,
              1 => 86,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 641194037760823296,
            'id_str' => '641194037760823296',
            'indices' => 
            array (
              0 => 87,
              1 => 109,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COX6lITVEAA0ZuS.jpg',
            'url' => 'http://t.co/QKNDDwcwzW',
            'display_url' => 'pic.twitter.com/QKNDDwcwzW',
            'expanded_url' => 'http://twitter.com/SobolLubov/status/641194039551856645/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 86,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 593,
                'h' => 150,
                'resize' => 'fit',
              ),
            ),
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    10 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 05:32:24 +0000 2015',
      'id' => 641121890392764416,
      'id_str' => '641121890392764416',
      'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей // Но арендовать дорогостоящие... http://t.co/WLOE3mHiTW',
      'source' => '<a href="http://www.facebook.com/twitter" rel="nofollow">Facebook</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 856020043,
        'id_str' => '856020043',
        'name' => 'Фонд i-демократии',
        'screen_name' => 'infodemocracy',
        'location' => '',
        'description' => 'Фонд информационной демократии',
        'url' => 'http://t.co/Qus79NvlMp',
        'entities' => 
        array (
          'url' => 
          array (
            'urls' => 
            array (
              0 => 
              array (
                'url' => 'http://t.co/Qus79NvlMp',
                'expanded_url' => 'http://f-id.ru',
                'display_url' => 'f-id.ru',
                'indices' => 
                array (
                  0 => 0,
                  1 => 22,
                ),
              ),
            ),
          ),
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 337,
        'friends_count' => 35,
        'listed_count' => 7,
        'created_at' => 'Mon Oct 01 07:59:10 +0000 2012',
        'favourites_count' => 1,
        'utc_offset' => 14400,
        'time_zone' => 'Abu Dhabi',
        'geo_enabled' => true,
        'verified' => false,
        'statuses_count' => 571,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/2672290742/6bd704ae7a34f8a45961a685e407ba24_normal.png',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/2672290742/6bd704ae7a34f8a45961a685e407ba24_normal.png',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'is_quote_status' => false,
      'retweet_count' => 0,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/WLOE3mHiTW',
            'expanded_url' => 'http://fb.me/7z0LUBQlF',
            'display_url' => 'fb.me/7z0LUBQlF',
            'indices' => 
            array (
              0 => 98,
              1 => 120,
            ),
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    11 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 05:23:05 +0000 2015',
      'id' => 641119544849764352,
      'id_str' => '641119544849764352',
      'text' => 'Капля камень точит. http://t.co/HG8Vz9ykzc',
      'source' => '<a href="http://www.facebook.com/twitter" rel="nofollow">Facebook</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 1287936614,
        'id_str' => '1287936614',
        'name' => 'РОИ',
        'screen_name' => 'rosiniciativa',
        'location' => '',
        'description' => '',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 821,
        'friends_count' => 1,
        'listed_count' => 16,
        'created_at' => 'Fri Mar 22 06:37:18 +0000 2013',
        'favourites_count' => 0,
        'utc_offset' => 14400,
        'time_zone' => 'Abu Dhabi',
        'geo_enabled' => false,
        'verified' => false,
        'statuses_count' => 242,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/3524372477/af5cde007945d7aa2988a0a734314884_normal.jpeg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/3524372477/af5cde007945d7aa2988a0a734314884_normal.jpeg',
        'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/1287936614/1366007074',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'is_quote_status' => false,
      'retweet_count' => 0,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/HG8Vz9ykzc',
            'expanded_url' => 'http://fb.me/7vXVZRHWr',
            'display_url' => 'fb.me/7vXVZRHWr',
            'indices' => 
            array (
              0 => 20,
              1 => 42,
            ),
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    12 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Tue Sep 08 03:51:52 +0000 2015',
      'id' => 641096590346874880,
      'id_str' => '641096590346874880',
      'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей http://t.co/2xUWf6tgTe',
      'source' => '<a href="http://www.apple.com" rel="nofollow">iOS</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 589840942,
        'id_str' => '589840942',
        'name' => 'Tatiana Shazzo',
        'screen_name' => 'TatianaShazzo',
        'location' => '',
        'description' => '',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 253,
        'friends_count' => 306,
        'listed_count' => 2,
        'created_at' => 'Fri May 25 09:13:48 +0000 2012',
        'favourites_count' => 255,
        'utc_offset' => NULL,
        'time_zone' => NULL,
        'geo_enabled' => false,
        'verified' => false,
        'statuses_count' => 12570,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/2250468966/image_normal.jpg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/2250468966/image_normal.jpg',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'is_quote_status' => false,
      'retweet_count' => 0,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/2xUWf6tgTe',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 64,
              1 => 86,
            ),
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    13 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Mon Sep 07 18:08:55 +0000 2015',
      'id' => 640949883885748224,
      'id_str' => '640949883885748224',
      'text' => 'Госслужащим теперь можно покупать автомобили не дороже 2,5 млн рублей. http://t.co/BBblUW6ijN http://t.co/KVZo4lyYYA',
      'source' => '<a href="https://about.twitter.com/products/tweetdeck" rel="nofollow">TweetDeck</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 459122317,
        'id_str' => '459122317',
        'name' => 'Обыватель',
        'screen_name' => 'obevatel',
        'location' => '',
        'description' => 'Свежий взгляд на жизнь',
        'url' => 'http://t.co/o3hGIY2B',
        'entities' => 
        array (
          'url' => 
          array (
            'urls' => 
            array (
              0 => 
              array (
                'url' => 'http://t.co/o3hGIY2B',
                'expanded_url' => 'http://incomesum.com',
                'display_url' => 'incomesum.com',
                'indices' => 
                array (
                  0 => 0,
                  1 => 20,
                ),
              ),
            ),
          ),
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 35,
        'friends_count' => 95,
        'listed_count' => 0,
        'created_at' => 'Mon Jan 09 09:23:54 +0000 2012',
        'favourites_count' => 0,
        'utc_offset' => -14400,
        'time_zone' => 'Eastern Time (US & Canada)',
        'geo_enabled' => false,
        'verified' => false,
        'statuses_count' => 1071,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => 'C0DEED',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme1/bg.png',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/556210653803724800/RxC93wqj_normal.jpeg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/556210653803724800/RxC93wqj_normal.jpeg',
        'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/459122317/1440440925',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'C0DEED',
        'profile_sidebar_fill_color' => 'DDEEF6',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => true,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'is_quote_status' => false,
      'retweet_count' => 0,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/BBblUW6ijN',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 71,
              1 => 93,
            ),
          ),
        ),
        'media' => 
        array (
          0 => 
          array (
            'id' => 640949332854853632,
            'id_str' => '640949332854853632',
            'indices' => 
            array (
              0 => 94,
              1 => 116,
            ),
            'media_url' => 'http://pbs.twimg.com/media/COUcBbfWUAATa4g.jpg',
            'media_url_https' => 'https://pbs.twimg.com/media/COUcBbfWUAATa4g.jpg',
            'url' => 'http://t.co/KVZo4lyYYA',
            'display_url' => 'pic.twitter.com/KVZo4lyYYA',
            'expanded_url' => 'http://twitter.com/obevatel/status/640949883885748224/photo/1',
            'type' => 'photo',
            'sizes' => 
            array (
              'medium' => 
              array (
                'w' => 600,
                'h' => 345,
                'resize' => 'fit',
              ),
              'small' => 
              array (
                'w' => 340,
                'h' => 195,
                'resize' => 'fit',
              ),
              'thumb' => 
              array (
                'w' => 150,
                'h' => 150,
                'resize' => 'crop',
              ),
              'large' => 
              array (
                'w' => 795,
                'h' => 458,
                'resize' => 'fit',
              ),
            ),
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
    14 => 
    array (
      'metadata' => 
      array (
        'result_type' => 'recent',
        'iso_language_code' => 'ru',
      ),
      'created_at' => 'Mon Sep 07 17:03:07 +0000 2015',
      'id' => 640933326027628544,
      'id_str' => '640933326027628544',
      'text' => 'RT @kommersant: Госслужащим запретили покупать автомобили дороже 2,5 млн рублей
http://t.co/zJFbLlDKCN',
      'source' => '<a href="http://twitter.com/download/iphone" rel="nofollow">Twitter for iPhone</a>',
      'truncated' => false,
      'in_reply_to_status_id' => NULL,
      'in_reply_to_status_id_str' => NULL,
      'in_reply_to_user_id' => NULL,
      'in_reply_to_user_id_str' => NULL,
      'in_reply_to_screen_name' => NULL,
      'user' => 
      array (
        'id' => 1267507260,
        'id_str' => '1267507260',
        'name' => 'Анна',
        'screen_name' => 'Anna_Romanoff',
        'location' => 'Санкт-Петербург',
        'description' => '',
        'url' => NULL,
        'entities' => 
        array (
          'description' => 
          array (
            'urls' => 
            array (
            ),
          ),
        ),
        'protected' => false,
        'followers_count' => 149,
        'friends_count' => 241,
        'listed_count' => 1,
        'created_at' => 'Thu Mar 14 17:03:08 +0000 2013',
        'favourites_count' => 2761,
        'utc_offset' => NULL,
        'time_zone' => NULL,
        'geo_enabled' => true,
        'verified' => false,
        'statuses_count' => 6330,
        'lang' => 'ru',
        'contributors_enabled' => false,
        'is_translator' => false,
        'is_translation_enabled' => false,
        'profile_background_color' => '9AE4E8',
        'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme16/bg.gif',
        'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme16/bg.gif',
        'profile_background_tile' => false,
        'profile_image_url' => 'http://pbs.twimg.com/profile_images/630685460633882624/-gI91Rf6_normal.jpg',
        'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/630685460633882624/-gI91Rf6_normal.jpg',
        'profile_link_color' => '0084B4',
        'profile_sidebar_border_color' => 'BDDCAD',
        'profile_sidebar_fill_color' => 'DDFFCC',
        'profile_text_color' => '333333',
        'profile_use_background_image' => true,
        'has_extended_profile' => false,
        'default_profile' => false,
        'default_profile_image' => false,
        'following' => NULL,
        'follow_request_sent' => NULL,
        'notifications' => NULL,
      ),
      'geo' => NULL,
      'coordinates' => NULL,
      'place' => NULL,
      'contributors' => NULL,
      'retweeted_status' => 
      array (
        'metadata' => 
        array (
          'result_type' => 'recent',
          'iso_language_code' => 'ru',
        ),
        'created_at' => 'Mon Sep 07 16:40:04 +0000 2015',
        'id' => 640927525913382913,
        'id_str' => '640927525913382913',
        'text' => 'Госслужащим запретили покупать автомобили дороже 2,5 млн рублей
http://t.co/zJFbLlDKCN',
        'source' => '<a href="http://twitter.com" rel="nofollow">Twitter Web Client</a>',
        'truncated' => false,
        'in_reply_to_status_id' => NULL,
        'in_reply_to_status_id_str' => NULL,
        'in_reply_to_user_id' => NULL,
        'in_reply_to_user_id_str' => NULL,
        'in_reply_to_screen_name' => NULL,
        'user' => 
        array (
          'id' => 874091436,
          'id_str' => '874091436',
          'name' => 'Коммерсантъ',
          'screen_name' => 'kommersant',
          'location' => 'ул. Врубеля д.4 стр. 1',
          'description' => 'Официальный твиттер Коммерсантъ-Online — kommersant.ru',
          'url' => 'http://t.co/HAzOwB2vPQ',
          'entities' => 
          array (
            'url' => 
            array (
              'urls' => 
              array (
                0 => 
                array (
                  'url' => 'http://t.co/HAzOwB2vPQ',
                  'expanded_url' => 'http://www.kommersant.ru',
                  'display_url' => 'kommersant.ru',
                  'indices' => 
                  array (
                    0 => 0,
                    1 => 22,
                  ),
                ),
              ),
            ),
            'description' => 
            array (
              'urls' => 
              array (
              ),
            ),
          ),
          'protected' => false,
          'followers_count' => 136808,
          'friends_count' => 255,
          'listed_count' => 884,
          'created_at' => 'Thu Oct 11 18:24:14 +0000 2012',
          'favourites_count' => 51,
          'utc_offset' => 14400,
          'time_zone' => 'Abu Dhabi',
          'geo_enabled' => true,
          'verified' => true,
          'statuses_count' => 38975,
          'lang' => 'ru',
          'contributors_enabled' => false,
          'is_translator' => false,
          'is_translation_enabled' => false,
          'profile_background_color' => '090A0A',
          'profile_background_image_url' => 'http://pbs.twimg.com/profile_background_images/433201075227607040/KfvWEFIe.jpeg',
          'profile_background_image_url_https' => 'https://pbs.twimg.com/profile_background_images/433201075227607040/KfvWEFIe.jpeg',
          'profile_background_tile' => true,
          'profile_image_url' => 'http://pbs.twimg.com/profile_images/2706183402/38345cfed7b54e0d94aa3c09e46b5f23_normal.jpeg',
          'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/2706183402/38345cfed7b54e0d94aa3c09e46b5f23_normal.jpeg',
          'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/874091436/1429527492',
          'profile_link_color' => '0B5091',
          'profile_sidebar_border_color' => '000000',
          'profile_sidebar_fill_color' => 'DDEEF6',
          'profile_text_color' => '333333',
          'profile_use_background_image' => false,
          'has_extended_profile' => false,
          'default_profile' => false,
          'default_profile_image' => false,
          'following' => NULL,
          'follow_request_sent' => NULL,
          'notifications' => NULL,
        ),
        'geo' => NULL,
        'coordinates' => NULL,
        'place' => NULL,
        'contributors' => NULL,
        'is_quote_status' => false,
        'retweet_count' => 4,
        'favorite_count' => 4,
        'entities' => 
        array (
          'hashtags' => 
          array (
          ),
          'symbols' => 
          array (
          ),
          'user_mentions' => 
          array (
          ),
          'urls' => 
          array (
            0 => 
            array (
              'url' => 'http://t.co/zJFbLlDKCN',
              'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
              'display_url' => 'kommersant.ru/doc/2805190',
              'indices' => 
              array (
                0 => 64,
                1 => 86,
              ),
            ),
          ),
        ),
        'favorited' => false,
        'retweeted' => false,
        'possibly_sensitive' => false,
        'lang' => 'ru',
      ),
      'is_quote_status' => false,
      'retweet_count' => 4,
      'favorite_count' => 0,
      'entities' => 
      array (
        'hashtags' => 
        array (
        ),
        'symbols' => 
        array (
        ),
        'user_mentions' => 
        array (
          0 => 
          array (
            'screen_name' => 'kommersant',
            'name' => 'Коммерсантъ',
            'id' => 874091436,
            'id_str' => '874091436',
            'indices' => 
            array (
              0 => 3,
              1 => 14,
            ),
          ),
        ),
        'urls' => 
        array (
          0 => 
          array (
            'url' => 'http://t.co/zJFbLlDKCN',
            'expanded_url' => 'http://www.kommersant.ru/doc/2805190',
            'display_url' => 'kommersant.ru/doc/2805190',
            'indices' => 
            array (
              0 => 80,
              1 => 102,
            ),
          ),
        ),
      ),
      'favorited' => false,
      'retweeted' => false,
      'possibly_sensitive' => false,
      'lang' => 'ru',
    ),
  ),
  'search_metadata' => 
  array (
    'completed_in' => 0.032000000000000001,
    'max_id' => 641205942101651456,
    'max_id_str' => '641205942101651456',
    'next_results' => '?max_id=640933326027628543&q=http%3A%2F%2Fwww.kommersant.ru%2Fdoc%2F2805190&include_entities=1&result_type=recent',
    'query' => 'http%3A%2F%2Fwww.kommersant.ru%2Fdoc%2F2805190',
    'refresh_url' => '?since_id=641205942101651456&q=http%3A%2F%2Fwww.kommersant.ru%2Fdoc%2F2805190&result_type=recent&include_entities=1',
    'count' => 15,
    'since_id' => 0,
    'since_id_str' => '0',
  ),
)