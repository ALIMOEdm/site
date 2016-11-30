<?php
namespace AppBundle\Util\Sentences;

class SentenceWorker {
    public static function ordutf8($string, &$offset) {
        $code = ord(substr($string, $offset,1));
        if ($code >= 128) {        //otherwise 0xxxxxxx
            if ($code < 224) $bytesnumber = 2;                //110xxxxx
            else if ($code < 240) $bytesnumber = 3;        //1110xxxx
            else if ($code < 248) $bytesnumber = 4;    //11110xxx
            $codetemp = $code - 192 - ($bytesnumber > 2 ? 32 : 0) - ($bytesnumber > 3 ? 16 : 0);
            for ($i = 2; $i <= $bytesnumber; $i++) {
                $offset ++;
                $code2 = ord(substr($string, $offset, 1)) - 128;        //10xxxxxx
                $codetemp = $codetemp*64 + $code2;
            }
            $code = $codetemp;
        }
        $offset += 1;
        if ($offset >= strlen($string)) $offset = -1;
        return $code;
    }

    public static function getFirstSentence($str){
        $text = $str;
        $offset = 0;
        $counter = 0;//количество символов, которое обработали
        $is_overflow = false;
        $min_length = 40;
        $max_length = 210;
        $ends_of_sentence = array(33, 46, 63);//33 - ! 46 - . 44 - , 63 - ?
        $space_code = 32;
        $comma_code = 44;
        $result = '';
        $cache_offset = 0;
        while ($offset >= 0) {
            $cache_offset = $offset;
            $code = self::ordutf8($text, $offset);

            if($counter >= $min_length){
                if(in_array($code, $ends_of_sentence)){
                    break;
                }
            }
            if($counter >= $max_length && !$is_overflow){
                $is_overflow = true;
                $ends_of_sentence[] = $comma_code;
            }

            if($is_overflow){
                if(in_array($code, $ends_of_sentence)){
                    break;
                }
            }

            $counter++;;
        }

        $result = mb_strcut($text, 0, $cache_offset);
        return $result;
    }
}