<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 17.08.16
 * Time: 10:08
 */

namespace AppBundle\Services\ThirdPartyServices;

/**
 * Class PopularNews Для формирования списка популярных новостей
 * @package AppBundle\Services\ThirdPartyServices
 */
class PopularNews extends BaseThirdParty{
    protected $em;
    protected $fields = array('popular_news');

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function formPopularNews()
    {
        $popular_news = $this->em->getRepository('AppBundle:News')->getPopularNews();

        $result = array();
        if (count($popular_news)) {
            foreach ($popular_news as $news) {
                $result[] = $news['id'];
            }
        }

        $result = array_unique($result);

        $this->save(
            array(
                'popular_news' => implode(',', $result),
            )
        );
    }

}