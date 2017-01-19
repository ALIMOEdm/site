<?php
namespace AppBundle\Services;

use AppBundle\Entity\DiscountNews;
use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use AppBundle\Util\Agro22;
use AppBundle\Util\AifAltay;
use AppBundle\Util\Altaisport;
use AppBundle\Util\AltapressParser;
use AppBundle\Util\AmicParser;
use AppBundle\Util\Ap22;
use AppBundle\Util\ASU;
use AppBundle\Util\BarnaulFm;
use AppBundle\Util\BarnaulMe;
use AppBundle\Util\Capitalist;
use AppBundle\Util\Culture22;
use AppBundle\Util\Doc22;
use AppBundle\Util\Ffprom;
use AppBundle\Util\KPParser;
use AppBundle\Util\MVDRF22;
use AppBundle\Util\MyAltay;
use AppBundle\Util\NashiNovostiTv;
use AppBundle\Util\News\NewsFiltration;
use AppBundle\Util\NewsPreview\FacebookStatis;
use AppBundle\Util\NewsPreview\NewsPreview;
use AppBundle\Util\PolitSibRu;
use AppBundle\Util\Rest22;
use AppBundle\Util\Sentences\SentenceWorker;
use AppBundle\Util\SibfoutMvd;
use AppBundle\Util\TwitterStatist;
use AppBundle\Util\VkRequests;
use AppBundle\Util\VKStatistic;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class NewsDownloader
 * @package AppBundle\Services
 */
class NewsDownloader
{

    protected $cache_img_size_by_url;
    public $em;
    public $group;
    protected $site_map;
    protected $router;
    public function __construct(EntityManager $entityManager, SiteMap $site_map, $router)
    {
        $this->em = $entityManager;
        $this->site_map = $site_map;
        $this->router = $router;
    }

    public function getNews($group_id, $count, $offset){
        $res = VkRequests::getLatestNews($group_id, $count, $offset);

        if(is_null($res)){
            throw new \Exception('Response is bad ');
        }

        if(!isset($res['response']) || !isset($res['response'][1])){
            throw new \Exception('Response is bad 2');
        }

        $resp = $res['response'][1];
        if($resp['from_id'] != $group_id){
            throw new \Exception('Creator of the news is not an admin');
        }

        return $resp;
    }

    /**
     * Get and save news from VK
     * @param $group_id
     * @param string $group_name
     * @param int $count
     * @param int $offset
     * @return bool
     * @throws \Exception
     */
    public function requestForNew($group_id, $group_name = '', $count = 1, $offset = 0){
        $this->setGroup($group_id);

        var_dump('//////////////////////////');
        var_dump($group_id);

        $images = array();
        $news_repository = $this->em->getRepository('AppBundle:News');

        try{
            $resp = $this->getNews($group_id, $count, $offset);
            $is_pinned = isset($resp['is_pinned']) ? $resp['is_pinned'] : '';
            if($is_pinned){
                $offset++;
                $resp = $this->getNews($group_id, $count, $offset);
            }
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

        $post_text = isset($resp['text']) ? $resp['text'] : '';

        $is_discount = false;
        $dates = array();

        mb_regex_encoding("UTF-8");
        mb_internal_encoding("UTF-8");
        if ($this->group->getGroupId() == -113535804 || $this->group->getGroupId() == -117465274) {
            if (mb_ereg_match('.*Новые акции в приложении.*', $post_text)) {
                return false;
            }
            $is_discount = true;
//            $post_text = "✔BELWEST возвращает 100% на бонусную карту
//В период с 14 августа до 21 сентября 2016 г. в сети BELWEST проходит рекламная акция «BELWEST возвращает 100% стоимости покупки на Вашу бонусную карту»:
//При совершении покупки обуви или сумок на белых ценниках 100% суммы покупки по чеку зачисляются на счет бонусной карты (1 рубль = 1 акционный балл).
//Подробности акции в приложении и в магазинах BELWEST!
//
//📱Отслеживай актуальные скидки, акции и мероприятия Барнаула!
//Скачать приложение: https://play.google.com/store/apps/details?id=com.dwd..
//#TopDiscount #topdiscount #топдисконт #topdis #TD #скидкибарнаул #распродажа #барнаул #barnaul";

//            $post_text = '✔1 октября - ДЕНЬ ШОПИНГА в ТРЦ "ОГНИ"!
//Только в этот день с 10:00 до 21:00 все отделы торгового центра предоставят максимальные скидки и специальные предложения любимым покупателям!
//На парковке ТРЦ "ОГНИ" состоится праздничный концерт; показ моделей одежды, обуви и аксессуаров осень-зима/2016; приятные сюрпизы и подарки для посетителей!
////
////📱Отслеживай актуальные скидки, акции и мероприятия Барнаула!
////Скачать приложение: https://play.google.com/store/apps/details?id=com.dwd..
////#TopDiscount #topdiscount #топдисконт #topdis #TD #скидкибарнаул #распродажа #барнаул #barnaul';

            //не работает
//            $post_text = '✔FUNDAY 3=2 на аксессуары!
//Только до 26 сентября в FUNDAY действует выгодная арифметика! Аксессуары, нижнее белье, носки и колготки - 3 вещи по цене 2! В акции участвует женский, мужской и детский ассортимент! Спешите порадовать себя и своих близких! FUNa много не бывает!
//Подробности акции в приложении!
////
////📱Отслеживай актуальные скидки, акции и мероприятия Барнаула!
////Скачать приложение: https://play.google.com/store/apps/details?id=com.dwd..
////#TopDiscount #topdiscount #топдисконт #topdis #TD #скидкибарнаул #распродажа #барнаул #barnaul';

//            $post_text = '✔Лучшие предложения сентября от «Модерн»:
//- выгодные цены;
//- подарки при покупках;
//- скидки в день рождение.
//Подробнее в приложении Top Discount
//
//📱Отслеживай актуальные скидки, акции и мероприятия Барнаула!
//Скачать приложение: https://play.google.com/store/apps/details?id=com.dwd..
//#TopDiscount #topdiscount #топдисконт #topdis #TD #скидкибарнаул #распродажа #барнаул #barnaul
//';
//
//            $post_text = 'СЕГОДНЯ16 СЕНТЯБРЯ - ОТКРЫТИЕ первых в Алтайском крае магазинов SINSAY CROPP MOHITO HOUS
//';

//            $post_text = ' Вусь Сентябрь и октябрь - ОТКРЫТИЕ первых в Алтайском крае магазинов SINSAY CROPP MOHITO HOUS
//';

//            $post_text =
//            'Будь в тренде вместе с ASKENT Group!
//
//Хит сезона – стильные мужские и женские рюкзаки со скидкой 10% в фирменных точках ASKENT и в интернет-магазине по промо-коду «BACKPACK10SALE».
//
//Акция действует с 15 по 18 сентября 2016 года.';

//            $post_text =
//            'Совсем скоро начнется определение победителя розыгрыша! А мы напоминаем что победителем будет участник группы который выполнил ВСЕ условия:
//Вступил в группу
//Скачал приложение на смартфон
//Сделал репост розыгрыша ЧЕРЕЗ ПРИЛОЖЕНИЕ себе на стену вк
//Поставить лайк посту:
//Розыгрыш:
//';
//            $post_text =
//            'выгодно в магазинах Pelican.
//            С 6 сентября 2016 года в сети фирменных магазинов Pelican и Pelican Kids действует акция на новую осеннюю коллекцию!.
//При покупке 2-х и более вещей из новой осенней коллекции скидка на каждую вторую вещь 40.
//Торопитесь! Акция действует до 26 сентября 2016 года.
//            ';

            while (true) {
                if (!preg_match('/#TopDiscount/', $post_text) && $this->group->getGroupId() != -117465274) {
                    $offset++;
                    $resp = $this->getNews($group_id, $count, $offset);
                    if($offset > 5) {
                        return false;
                    }
                    $post_text = isset($resp['text']) ? $resp['text'] : '';
                } else {
                    break;
                }
            }


            $post_text = mb_ereg_replace('[^а-яА-Я\w\s\.!\/:"\-\(\)=\?\#@<>]+', '', $post_text);
            $post_text = mb_ereg_replace('Отслеживай актуальные скидки.*$', '', $post_text);
            $post_text = mb_ereg_replace('Скачать приложение.*$', '', $post_text);

            $months = array(
                'сентябр' => 9,
                'январ' => 1,
                'феврал' => 2,
                'март' => 3,
                'апрел' => 4,
                'май' => 5,
                'мая' => 5,
                'июн' => 6,
                'июл' => 7,
                'август' => 8,
                'октябр' => 10,
                'ноябр'=> 11,
                'декабр' => 12
            );


            $months_flipped = array_flip($months);

            $m = array();
            $temp = mb_strtolower($post_text);
            var_dump($temp);
            foreach ($months as $month => $m_number) {
                if (mb_ereg_match('.* '.$month.'.*', $temp)) {
                    var_dump($month);
                    $offset = mb_strpos($temp, $month);
                    $m[] = array(
                        'offset' => $offset,
                        'month_number' => $m_number,
                    );
                }
            }
            if (count($m) > 1) {
                usort($m, function ($a, $b)
                {
                    if ($a['offset'] == $b['offset']) {
                        return 0;
                    }
                    return ($a['offset'] < $b['offset']) ? -1 : 1;
                });
            }

            var_dump($m);
            $date = new \DateTime();

            if (count($m) == 2) {
                $pred_offset = 0;
                foreach ($m as $key => $value) {
                    $len = $value['offset'] + mb_strlen($months_flipped[$value['month_number']]);
                    $substring = mb_strtolower(mb_substr($post_text,0,$len,"UTF-8"));
                    $res = array();
                    $reg_exp = '(.* |^)(\d+.*'.$months_flipped[$value['month_number']].')';
                    mb_ereg($reg_exp, $substring, $res);
                    $day = 1;
                    if (count($res)) {
                        $res_need = isset($res[2]) ? $res[2] : '';
                        $res_2 = array();
                        mb_ereg('\d+', $res_need, $res_2);
                        $day = isset($res_2[0]) ? $res_2[0] : '';
                    } else {
                        if ($key != 0) {
                            $a_date = $date->format('Y')."-".$value['month_number']."-".$date->format('d');
                            $day = date("t", strtotime($a_date));
                        }
                    }
                    $dates[] = array(
                        'day' => $day,
                        'month' => $value['month_number']
                    );
                }
            } elseif (count($m) == 1) {
                //если у нас 1 месяц в объявлении
                $value = $m[0];
                $len = $value['offset'] + mb_strlen($months_flipped[$value['month_number']]);
                $substring = mb_strtolower(mb_substr($post_text,0,$len,"UTF-8"));
                // если у нас число и месяцу(что ли бо...23 сентября)
                $reg_exp = '(.*[^0-9]|^)((\d+).*'.$months_flipped[$value['month_number']].')';
                $res = array();
                mb_ereg($reg_exp, $substring, $res);
                var_dump($res);
                $day_to = 1;
                $day_from = 1;
                if (count($res)) {
                    $res_need = isset($res[2]) ? $res[2] : '';
                    if ($res_need) {
                        $res_2 = array();
                        mb_ereg('\d+', $res_need, $res_2);
                        $day_to = isset($res_2[0]) ? $res_2[0] : '';
                        //тогда смотрим, есть ли второе число(что то ... с 12 по 13 сентября)
                        $reg_exp = '(.*[^0-9]|^)(\d\d?)[^0-9]+(\d\d?)[^0-9]*'.$months_flipped[$value['month_number']].'';
                        $res = array();
                        var_dump($substring);
                        mb_ereg($reg_exp, $substring, $res);
                        var_dump($res);
                        if (isset($res[2])) {
                            $day_from = $res[2] ? $res[2] : $day_to;
                            if (!$res[2]) {
                                if (mb_ereg_match('.* по .*'.$months_flipped[$value['month_number']], $substring) || mb_ereg_match('.* до .*'.$months_flipped[$value['month_number']], $substring)) {
                                    $day_from = (new \DateTime())->format('d');
                                }
                            }
                        } else {
                            $day_from = $day_to;
                        }
                    } else {
                        $a_date = $date->format('Y')."-".$value['month_number']."-".$date->format('d');
                        $day_to = date("t", strtotime($a_date));
                    }
                } else {
                    $a_date = $date->format('Y')."-".$value['month_number']."-".$date->format('d');
                    $day_to = date("t", strtotime($a_date));
                }
                $dates[] = array(
                    'day' => $day_from,
                    'month' => $value['month_number']
                );
                $dates[] = array(
                    'day' => $day_to,
                    'month' => $value['month_number']
                );

            } else {
                $dates[] = array(
                    'day' => (new \DateTime())->sub(new \DateInterval('P5D'))->format('d'),
                    'month' => (new \DateTime())->format('m')
                );
                $dates[] = array(
                    'day' => (new \DateTime())->add(new \DateInterval('P10D'))->format('d'),
                    'month' => (new \DateTime())->format('m')
                );
            }

            $cur_month = (new \DateTime())->format('m');
            $cur_year = (new \DateTime())->format('Y');
            $dates[0]['year'] = $cur_year;
            $dates[1]['year'] = $cur_year;
            if ((int)$dates[1]['month'] < $cur_month && (int)$dates[0]['month'] > $cur_month) {
                $dates[0]['year'] = $cur_year;
                $dates[1]['year'] = $cur_year + 1;
            } else if ((int)$dates[1]['month'] < $cur_month && (int)$dates[0]['month'] < $cur_month) {
                $dates[0]['year'] = $cur_year + 1;
                $dates[1]['year'] = $cur_year + 1;
            }

            $dates[0]['time'] = '00:00:00';
            $dates[1]['time'] = '23:59:59';

        }

        $post_text = preg_replace('/#[^ ]+/', '', $post_text);
        $post_text = preg_replace('/<script[^>]*>(.*?)<\/script>/', '', $post_text);
        $post_type = isset($resp['post_type']) ? $resp['post_type'] : '';
        $post_date = isset($resp['date']) ? $resp['date'] : '';
        $post_id = isset($resp['id']) ? $resp['id'] : '';

        if($news_repository->checkNewsExists($post_id, $group_id)){
            throw new \Exception('The news already exists');
        }

        $news = new News();
        $news->setNewsDate($post_date);
        $news->setNewsId($post_id);
        /**
         * select and then remove all references
         */
        preg_match_all('/(http(s?):\/\/[^ ]*)/',$post_text, $matches);
        $post_text = preg_replace('/(http(s?):\/\/[^ ]*)/', '', $post_text );
        $post_text = preg_replace('/[|]+[ ]*.*/', '', $post_text );
        $post_text = preg_replace('/\[club[^\]]*\]/', '', $post_text );
        $post_text = preg_replace('/(<(br\/?)>){2,}/', '.<br/>', $post_text );
        $post_text = preg_replace('/[.]+/', '.', $post_text );
        $post_text = trim($post_text);



        $text = '';
        $news_prev = new NewsPreview();
        $news_info = array();
        $news_external_link = '';
        var_dump($post_text);
        if(count($matches)){
            foreach($matches as $m){
                $m = isset($m[0]) && !empty($m[0]) ? $m[0] : '';
                if($m){
                    $m = $this->getOriginUrlFromRedirect($m);
                    $text = $this->parseNewsSite($m);

//                    if(count($news_info)){
//                        $f_cnt = FacebookStatis::getNewsCnt($m);
//                        $vk_cnt = VKStatistic::getNewsCnt($m);
//                        $tw_cnt = TwitterStatist::getNewsCnt($m);
//                    }
                }
                if($text && strlen($text) > 200){
                    $news_info = $news_prev->getPrev($m);
                    $news_external_link = $m;
                    break;
                }
            }

        }

        $post_text = preg_replace('/(http(s?):\/\/[^ ]*)/','', $post_text);
        if(mb_strlen($post_text) > 180){
            $news->setNewsDescription($post_text);
            //get first sentence from long text
            $title = SentenceWorker::getFirstSentence($post_text);
            //replace <br>
            $title = preg_replace('/(<br[^>]*>\s*){1,}/', '. ', $title);
            $news->setNewsTitle($title);
        }else{
            $title = preg_replace('/(<br[^>]*>\s*){1,}/', '. ', $post_text);
            $news->setNewsTitle($title);
        }

        //сохраним на всякий случай, если мы стянули данные с сайта, то пусть еще хранится текст из вк
        $news->setNewsTextOrigin(($post_text));

        if($text){
            $news->setNewsTextParsed(trim($text));
        }
        if(count($news_info)){
            if(isset($news_info['title']) && trim($news_info['title'])){
                $news->setNewsTitle($news_info['title']);
            }
            if(isset($news_info['description']) && trim($news_info['description'])){
                $news->setNewsDescription($news_info['description']);
            }
            if(isset($news_info['image']) && trim($news_info['image'])){
                $picture = new NewsPicture();
                $picture->setUrl($news_info['image']);
                $size = $this->getImageSize($news_info['image']);
                $picture->setSize($size);
                $size = $this->getImageSizeInt($news_info['image']);
                $picture->setSizeInt($size);
                $news->addPhoto($picture);
                $picture->setNews($news);
                $images[] = $picture;
//                $this->em->persist($picture);
            }
            $news->setNewsSiteLink($news_info['url']);
        }

        if($news_external_link){
            $news->setNewsSiteLink($news_external_link);
        }

        $gr_url = $this->getGroupUrl($group_id);
        $gr_url .= '?w=wall'.$group_id.'_'.$news->getNewsId();
        $news->setNewsVkLink($gr_url);
        $attachments = isset($resp['attachments']) ? $resp['attachments'] : array();
        if(count($attachments)){
            foreach($attachments as $att){
                if($att['type'] == 'photo'){
                    $ph = $att['photo'];
                    $picture = new NewsPicture();

                    $url = '';
                    if(isset($ph['src_xxbig'])){
                        $url = $ph['src_xxbig'];
                    }elseif(isset($ph['src_xbig'])){
                        $url = $ph['src_xbig'];
                    }elseif(isset($ph['src_big'])){
                        $url = $ph['src_big'];
                    }elseif(isset($ph['src'])){
                        $url = $ph['src'];
                    }
                    if (!$url || !$this->checkRemoteFile($url)) {
                        continue;
                    }
                    $picture->setUrl($url);

                    if($url){
                        $size = $this->getImageSize($url);
                        $picture->setSize($size);
                        $size = $this->getImageSizeInt($url);
                        $picture->setSizeInt($size);
                        $news->addPhoto($picture);
                        $picture->setNews($news);
                        $images[] = $picture;
                    }
                }
                elseif($att['type'] == 'video'){
                    $vi = $att['video'];
                    if(!$news->getNewsTitle()) {
                        if(isset($vi['title']) && trim($vi['title'])){
                            $news->setNewsTitle($vi['title']);
                        }
                        if(isset($vi['description']) && trim($vi['description'])){
                            $news->setNewsDescription($vi['description']);
                        }
                    }

                    $picture = new NewsPicture();

                    $url = '';
                    if(isset($vi['image_xbig'])){
                        $url = $vi['image_xbig'];
                    }elseif(isset($vi['image_big'])){
                        $url = $vi['image_big'];
                    }elseif(isset($vi['image_small'])){
                        $url = $vi['image_small'];
                    }elseif(isset($vi['image'])){
                        $url = $vi['image'];
                    }
                    if (!$url || !$this->checkRemoteFile($url)) {
                        continue;
                    }
                    $picture->setUrl($url);

                    if($url){
                        $size = $this->getImageSize($url);
                        $picture->setSize($size);
                        $size = $this->getImageSizeInt($url);
                        $picture->setSizeInt($size);
                        $news->addPhoto($picture);
                        $picture->setNews($news);
                        $images[] = $picture;
                    }

                }
                elseif($att['type'] == 'link'){

                    $link = $att['link'];

                    $text_2 = $this->parseNewsSite($link['url']);

                    if($text_2 && strlen($text_2) > 300 && !$text){
                        $news->setNewsTextParsed(trim($text_2));
                    }

                    if(!$news->getNewsTitle()) {
                        if(isset($link['title']) && trim($link['title'])){
                            $news->setNewsTitle($link['title']);
                        }
                        if(isset($link['description']) && trim($link['description'])){
                            $news->setNewsDescription($link['description']);
                        }
                        $news->setNewsSiteLink($link['url']);
                    }

                    $picture = new NewsPicture();
                    $url = '';
                    if(isset($link['image_src'])){
                        $url = $link['image_src'];
                    }
                    if(isset($link['image_big'])){
                        $url = $link['image_big'];
                    }
                    if (!$url || !$this->checkRemoteFile($url)) {
                        continue;
                    }
                    $picture->setUrl($url);
                    if($url){
                        $size = $this->getImageSize($url);
                        $picture->setSize($size);
                        $size = $this->getImageSizeInt($url);
                        $picture->setSizeInt($size);
                        $news->addPhoto($picture);
                        $picture->setNews($news);
                        $images[] = $picture;
                    }
                }

            }
        }

        if($news->getNewsTitle()){
            if(!NewsFiltration::isValidText($news->getNewsTitle())){
                return false;
            }
            $this->group->addNews($news);
            $news->setVkGroup($this->group);
            $news->setCategory($this->group->getCategory());
            $this->em->persist($news);
//            var_dump('news_title');
//            var_dump($news->getNewsTitle());
            foreach($images as $p){
                $this->em->persist($p);
            }

            if ($is_discount) {
                $discountNews = new DiscountNews();
                $discountNews->setDateStart(new \DateTime($dates[0]['year'].'-'
                                            .$dates[0]['month'].'-'.
                                            $dates[0]['day'].' '.
                                            $dates[0]['time']));
                $discountNews->setDateFinish(new \DateTime($dates[1]['year'].'-'
                    .$dates[1]['month'].'-'.
                    $dates[1]['day'].' '.
                    $dates[1]['time']));
                $discountNews->setNews($news);
                $this->em->persist($discountNews);
            }
            $this->em->flush();

            // Refresh siteMap
            $url = $this->router->generate('one_news_router', ['gr_news_id'=> $news->getNewsIdFunc()], UrlGeneratorInterface::ABSOLUTE_URL);
            $this->site_map->addToSiteMap($url);

            return true;
        }
        return false;
    }

    /**
     * Barnaul Parse News site
     * @param $url
     * @return string
     */
    function parseNewsSite($url){
        $m = $url;
        $text = '';
        if(preg_match('/sibfout.mvd.ru/i', $m) || preg_match('/22.mvd.ru/i', $m)){
            $mvd = new SibfoutMvd();
            $r = $mvd->getArticle($m);
            $text = $mvd->parse($r);
        }elseif(preg_match('/amic.ru/i', $m)){
            $amic = new AmicParser();
            $r = $amic->getArticle($m);
            $text = $amic->parse($r);
        }elseif(preg_match('/altapress.ru/i', $m)){
            $altpr = new AltapressParser();
            $r = $altpr->getArticle($m);
            $text = $altpr->parse($r);
        }elseif(preg_match('/asu.ru/i', $m)){
            $asu = new ASU();
            $r = $asu->getArticle($m);
            $text = $asu->parse($r);
        }elseif(preg_match('/ffprom22.ru/i', $m)){
            $ff = new Ffprom();
            $r = $ff->getArticle($m);
            $text = $ff->parse($r);
        }elseif(preg_match('/doc22.ru/i', $m)){
            $doc = new Doc22();
            $r = $doc->getArticle($m);
            $text = $doc->parse($r);
        }elseif(preg_match('/culture22.ru/i', $m)){
            $cult = new Culture22();
            $r = $cult->getArticle($m);
            $text = $cult->parse($r);
        }elseif(preg_match('/barnaul.me/i', $m)){
            $brn_me = new BarnaulMe();
            $r = $brn_me->getArticle($m);
            $text = $brn_me->parse($r);
        }elseif(preg_match('/rest22.ru/i', $m)){
            $rest = new Rest22();
            $r = $rest->getArticle($m);
            $text = $rest->parse($r);
        }elseif(preg_match('/altaisport.ru/i', $m)){
            $alt_sport = new Altaisport();
            $r = $alt_sport->getArticle($m);
            $text = $alt_sport->parse($r);
        }elseif(preg_match('/altagro22.ru/i', $m)){
            $agro = new Agro22();
            $r = $agro->getArticle($m);
            $text = $agro->parse($r);
        }elseif(preg_match('/barnaul.fm/i', $m)){
            $agro = new BarnaulFm();
            $r = $agro->getArticle($m);
            $text = $agro->parse($r);
        }elseif(preg_match('/ap22.ru/i', $m)){
            $ap_22 = new Ap22();
            $r = $ap_22->getArticle($m);
            $text = $ap_22->parse($r);
        }elseif(preg_match('/kp.ru/i', $m)){
            $kp = new KPParser();
            $r = $kp->getArticle($m);
            $text = $kp->parse($r);
        }elseif(preg_match('/myaltai.com/i', $m)){
            $malt = new MyAltay();
            $r = $malt->getArticle($m);
            $text = $malt->parse($r);
        }elseif(preg_match('/kapitalist.tv/i', $m)){
            $capitalist = new Capitalist();
            $r = $capitalist->getArticle($m);
            $text = $capitalist->parse($r);
        }elseif(preg_match('/мвд.рф/i', $m)){
            $mvd = new MVDRF22();
            $r = $mvd->getArticle($m);
            $text = $mvd->parse($r);
        }elseif(preg_match('/altai.aif.ru/i', $m)){
            $aif = new AifAltay();
            $r = $aif->getArticle($m);
            $text = $aif->parse($r);
        }elseif(preg_match('/politsib.ru/i', $m)){
            $politsib = new PolitSibRu();
            $r = $politsib->getArticle($m);
            $text = $politsib->parse($r);
        }elseif(preg_match('/nashinovosti.tv/i', $m)){
            $politsib = new NashiNovostiTv();
            $r = $politsib->getArticle($m);
            $text = $politsib->parse($r);
        }
        return $text;
    }

    public function setGroup($group_id){
        $this->group = $this->em->getRepository('AppBundle:VKGroup')->findOneBy(array('group_id' => $group_id));
    }

    public function getGroupUrl(){
        return $this->group->getGroupUrl();
    }

    /**
     * Classification images by size
     * @param $url
     * @return string
     */
    public function getImageSize($url){
        if (!$this->checkRemoteFile($url)) {
            return 'small';
        }
        if(!isset($this->cache_img_size_by_url[$url])){
            $this->cache_img_size_by_url[$url] = getimagesize($url);
        }
        $type = $this->cache_img_size_by_url[$url];
        $type = $type[0];
        if($type < 151){
            return 'small';
        }
        if($type < 250){
            return 'medium';
        }
        if($type < 350){
            return 'xmedium';
        }
        if($type < 450){
            return 'xxmedium';
        }
        if($type < 550){
            return 'xxxmedium';
        }
        if($type < 650){
            return 'big';
        }
        if($type < 750){
            return 'xbig';
        }
        else{
            return 'xxbig';
        }
    }

    function checkRemoteFile($url)
    {
        $timeout = 5; //timeout seconds

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_TIMEOUT, $timeout);

        return (curl_exec($ch)!==FALSE);
    }

    /**
     * Classification images by size
     * @param $url
     * @return int
     */
    public function getImageSizeInt($url){
        if (!$this->checkRemoteFile($url)) {
            return 1;
        }
        if(!isset($this->cache_img_size_by_url[$url])){
            $this->cache_img_size_by_url[$url] = getimagesize($url);
        }
        $type = $this->cache_img_size_by_url[$url];
        $type = $type[0];
        if($type < 151){
            return 1;
        }
        if($type < 250){
            return 2;
        }
        if($type < 350){
            return 3;
        }
        if($type < 450){
            return 4;
        }
        if($type < 550){
            return 4;
        }
        if($type < 650){
            return 5;
        }
        if($type < 750){
            return 6;
        }
        else{
            return 7;
        }
    }

    public function requestForNews(){
        $cnt = 0;
        while($cnt < 7) {
            $cnt++;
            $group = $this->em->getRepository('AppBundle:VKGroup')->getNext();
            if (count($group)) {
                $group = $group[0];
                $group->setRequestedDate(new \DateTime());
                $this->em->persist($group);
                $this->em->flush();
                try{
                    $this->requestForNew($group->getGroupId(), $group->getGroupName());
                }catch (\Exception $e){
                    echo $e->getMessage();
                }
            }
        }
    }

    /**
     * Пытаемся обойти всякие минимизаторы ссылок
     *
     * @param $url
     * @return mixed
     */
    public function getOriginUrlFromRedirect($url)
    {
        $counter = 0;
        while (true) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($ch);
            $info = curl_getinfo($ch);
            if (isset($info['http_code']) && ($info['http_code'] == 302 || $info['http_code'] == 301)) {
                $url = $info['redirect_url'];
            } elseif (isset($info['http_code'])
                && ($info['http_code'] < 300 || $info['http_code'] <= 400 )
            ) {
                return $url;
            }
            $counter++;
            if($counter > 30) {
                break;
            }
        }
        return $url;

    }
}