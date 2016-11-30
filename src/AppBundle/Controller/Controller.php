<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 26.04.2016
 * Time: 21:37
 */

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Controller extends BaseController{
    public function setAdditionalFiledToSkin($ent, $e)
    {
        $cnt_views = isset($ent['cnt_views']) ? $ent['cnt_views'] : 0;

        $e->setCntViews($cnt_views);

        return $e;
    }

    public function setFilters(Request $request, $session_key){
        $need_groups = $request->query->get('group_filter', '');
        $date_interval = $request->query->get('date_interval', '');
        $date_array = explode(',', $date_interval);
        $date_from = isset($date_array[0]) && $date_array[0] ? $date_array[0] : '';
        $date_to = isset($date_array[1]) && $date_array[1] ? $date_array[1] : '';
        $search_words = trim($request->query->get('search_words', ''));

        if($need_groups && is_array($need_groups)){
        }else{
            $need_groups = array();
        }

        $date_start = '';
        $date_start_ob = \DateTime::createFromFormat($this->getParameter('date_filter_format'), $date_from);
        if($date_start_ob){
            $date_start = $date_start_ob->format('Y-m-d');
        }
        $date_finish = '';
        $date_finish_ob = \DateTime::createFromFormat($this->getParameter('date_filter_format'), $date_to);
        if($date_finish_ob){
            $date_finish = $date_finish_ob->format('Y-m-d');
        }


//        if(!count($need_groups) && !$date_start && !$date_finish && !$search_words){
//            if($request->isMethod('GET')){
//                $data = $this->get('session')->get($session_key);
//                $data = json_decode($data, true, 512);
//                if($data){
//                    $need_groups = isset($data['groups']) ? $data['groups'] : array();
//                    $date_start = isset($data['date_start']) ? $data['date_start'] : '';
//                    $date_finish = isset($data['date_finish']) ? $data['date_finish'] : '';
//                    $search_words = isset($data['search_words']) ? $data['search_words'] : '';
//                }
//            }else{
//                $data = array(
//                    'groups' => $need_groups,
//                    'date_start' => $date_start,
//                    'date_finish' => $date_finish,
//                    'search_words' => $search_words,
//                );
//                $this->get('session')->set($session_key, json_encode($data));
//            }
//        }else{
//            $data = array(
//                'groups' => $need_groups,
//                'date_start' => $date_start,
//                'date_finish' => $date_finish,
//                'search_words' => $search_words,
//            );
//            $this->get('session')->set($session_key, json_encode($data));
//        }

        if($date_start){
            $date_start .= ' 00:00:00';
        }
        if($date_finish){
            $date_finish .= ' 23:59:59';
        }

        $data = array(
            'groups' => $need_groups,
            'date_start' => $date_start,
            'date_finish' => $date_finish,
            'search_words' => $search_words,
            'date_interval' => $date_interval,
        );
        return $data;
    }

    public function constructConditionForCommentSearch($search_words, $search_type = ''){
        $search_words = trim(strip_tags($search_words));
        if(!$search_words){
            return '';
        }
        $searchWords = explode(' ', $search_words);

        $query = ' ';

        $zap = '';
        $skob = '';


        //here we try get string like
        /*
         * IF(comment.comment LIKE '%Tom%',
         *      IF(comment.comment LIKE '%Tom Soyer%',
         *          IF(comment.comment LIKE '%Tom Soyer Petrov%'),
         *              3,
         *              2),
         *          1),
         *      IF(comment.comment LIKE '%Soyer%',
         *          IF(comment.comment LIKE '%Soyer Petrov%',
         *              2,
         *              1),
         *          IF(comment.comment LIKE '%Petrov%',
         *              1,
         *              0)
         *      )
         *)
         */
        foreach ($searchWords as $ind => $searchWord) {
            if(!trim($searchWord)){
                continue;
            }
            $fst = 1;
            $end = '';
            $rel = 0;
            $previos = '';
            $zap = '';
            foreach($searchWords as $in_ind => $searchWord_2){
                if(!trim($searchWord_2)){
                    continue;
                }
                if($ind > $in_ind){
                    continue;
                }
                $previos .= $previos ? ' '.$searchWord_2 : $searchWord_2;

                $query .= $zap." IF(n.news_title LIKE '%".$previos."%' OR n.news_description LIKE '%".$previos."%' OR n.news_text_origin  LIKE '%".$previos."%' ";


                if(!$fst){
                    $end = $rel.')'.$zap.$end;
                }
                $fst = 0;

                $zap = ',';
                $rel++;

            }
            $query .= ','.$rel.','.$end;
            $skob .= ')';
        }
        if($query) {
            $query .= '0' . $skob;
        }

        return $query;
    }
}