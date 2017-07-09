<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\NewsCategory;
use AppBundle\Entity\Repository\NewsCategoryRepository;
use AppBundle\Entity\VKGroup;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class VKGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var NewsCategoryRepository $newsCategoryRepository */
        $newsCategoryRepository = $manager->getRepository(NewsCategory::class);
        /** @var NewsCategory[] $newsCategories */
        $newsCategories = $newsCategoryRepository->findAll();
        /** @var NewsCategory[] $newsCategoriesList */
        $newsCategoriesList = [];
        foreach ($newsCategories as $value) {
            $newsCategoriesList[$value->getIndentity()] = $value;
        }

        foreach ($this->getData() as $groupData) {
            $group = new VKGroup();
            $group->setGroupId($groupData[1]);
            $group->setGroupName($groupData[2]);
            $group->setGroupTheme($groupData[3]);
            $group->setRequestedDate(\DateTime::createFromFormat('Y-m-d H:i:s', $groupData[4]));
            $group->setDeleted($groupData[5]);
            $group->setGroupTitle($groupData[6]);
            $group->setGroupUrl($groupData[7]);
            if ($newsCategoriesList[$groupData[8]]) {
                $group->setCategory($newsCategoriesList[$groupData[8]]);
            }
            $group->setLogo($groupData[9]);
            $group->setDescription($groupData[10]);

            $manager->persist($group);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

    public function getData()
    {
        $data = [
            ['1','-71731022','amic','news','2017-07-09 11:05:02','0','Новости Барнаула amic.ru','https://vk.com/amic_ru','news','https://pp.vk.me/c629125/v629125283/322f5/s1CanfOFUuQ.jpg','Узнавай о происшествиях и событиях моментально!',],
            ['2','-20351570','altapress','news','2017-07-09 11:05:01','0','Алтапресс','https://vk.com/altapress','news','https://pp.vk.me/c627427/v627427762/3f0b6/GCcsy0vzlyw.jpg','Новости Алтайского края',],
            ['3','-38551279','barnaul22','different','2016-07-24 07:30:02','1','Barnaul 22','https://vk.com/barneos22','different','https://pp.vk.me/c630224/v630224351/2918b/RUyplAJMVIM.jpg','ТОП новости. Видео материалы, фото коллекции, анонсы крупных Барнаульских авто тем, соревнований, шоу, выставок и т.д. 18+',],
            ['4','-44984496','tp_barnaul','different','2017-07-09 11:05:04','0','Типичный Барнаул','https://vk.com/typical_brn','different','','',],
            ['5','-56877418','alt_brn_news','news','2017-07-09 11:06:01','0','Алтай Барнаул Новости','https://vk.com/altaypro','news','https://pp.vk.me/c410920/v410920752/dae1/WFAPrNHsHLE.jpg','Новости Алтая и Барнаула',],
            ['6','-113426229','alt_sport','news_sport','2017-07-09 11:06:02','0','Алтайский спорт','https://vk.com/altaisport_ru','news_sport','https://pp.vk.me/c629422/v629422287/30b68/P9OPsgFjjjc.jpg','Новости алтайского спорта, актуальные репортажи с места событий, красочные фотографии, аналитические материалы',],
            ['7','-90652015','i_live_barnaul','different','2016-07-23 16:19:02','1','Я живу [В] Барнауле','https://vk.com/live_barnaul','different','https://pp.vk.me/c604520/v604520271/10b02/GduSyHo5dBI.jpg','Барнаулец? Заходи!',],
            ['8','-41063','barnauls','different','2016-07-23 16:19:02','1','Барнаульцы, Объединяйтесь','https://vk.com/barnauls','different','https://pp.vk.me/c633518/v633518731/ac41/3XP2_PInFNo.jpg','Новости Алтая и Барнаула',],
            ['9','-77905270','alt_pravda','news','2017-07-09 11:06:02','0','Алтайская правда','https://vk.com/ap22ru','news','https://pp.vk.me/c618722/v618722909/1b031/fL7lnnF7gxk.jpg','Новости Барнаула, Алтайского края',],
            ['10','-66778909','alta_traveling','traveling','2017-07-09 11:06:03','0','Алтай | Путешествия и Туризм','https://vk.com/vputi_su','traveling','https://pp.vk.me/c629117/v629117467/33a09/e4PeEmw1JDk.jpg','Паблик о путешествиях по Алтаю',],
            ['11','-54294495','vizit_altay','traveling','2017-07-09 11:07:01','0','ВИЗИТАЛТАЙ.РФ','https://vk.com/visitaltai','traveling','https://pp.vk.me/c617924/v617924651/c2ef/qOuEY2Tbc98.jpg','Новости Алтая и Барнаула',],
            ['12','-27573890','gotoaltay','traveling','2017-07-09 11:07:02','0','gotoaltay.ru - Туризм и отдых на Алтае','https://vk.com/edemnaaltay','traveling','https://pp.vk.me/c630226/v630226860/36f76/wsuFXe5mZaE.jpg','Каталог гостевых домов, усадьбы, коттеджи, небольшие базы отдыха',],
            ['13','-64889271','sport_fm','news_sport','2017-07-09 11:07:02','0','Алтайский спорт','https://vk.com/sportfmbarnaul','news_sport','https://pp.vk.me/c629326/v629326300/1abcf/dvroOvbLf48.jpg','Новости алтайского спорта',],
            ['14','-84995472','news_barneo_afisha','news','2017-07-09 11:07:02','0','Новости Барнаула, афиша | Мой Барнаул ✔','https://vk.com/barnaulme','news','https://pp.vk.me/c622318/v622318361/56809/cQXkYqTub2g.jpg','Весь Барнаул как на ладони! Анонсы мероприятий, афиша, городские новости, много интересной информации о городе, все, чем дышит Барнаул!',],
            ['15','-33152126','afiha_brn','afisha','2017-07-09 11:07:02','0','Афиша Барнаула','https://vk.com/rest22','afisha','http://s.rest22.ru/i/rest22-logo.gif','Афиша Барнаула и журнал о культурной жизни города. Смотрите, слушайте, участвуйте! Отдыхайте интересно!',],
            ['16','-96285667','power_brn','news','2017-07-09 11:07:02','0','POWER TV | Барнаул — новости, афиша, скидки.','https://vk.com/power_barnaul','news','','',],
            ['19','-15495672','kult_pohod','afisha','2017-07-09 11:07:02','0','Культпоход','https://vk.com/kultpohod','afisha','https://pp.vk.me/c617417/v617417732/143ca/VwRY1N4fAJU.jpg','Новые места, персоны и события твоего города',],
            ['20','-42168640','barnaulfm','news','2017-07-09 11:04:03','0','Барнаул.фм','https://vk.com/barnaul_fm','news','https://pp.vk.me/c625520/v625520472/50d2c/NQvJLRXgSpY.jpg','Городской журнал: новости и истории',],
            ['21','-18825964','kp_barnaul','news','2017-07-09 11:05:01','0','Комсомольская правда - Барнаул','https://vk.com/kp.barnaul','news','https://pp.vk.me/c630824/v630824931/2eb97/r-P2ss3hSKs.jpg','Новости Алтая и Барнаула',],
            ['22','-117465274','skidki_brn','discount','2017-07-09 11:04:03','0','Скидки, акции и распродажи в Барнауле','https://vk.com/skidki_barnaul','discount','https://pp.vk.me/c633918/v633918218/33367/UPsk0RUdP0E.jpg','Наша группа создана с целью помочь жителям города Барнаула совершать выгодные покупки и экономить деньги на приобретении всевозможных товаров',],
            ['23','-48633809','fm-prodakshn','news','2017-07-09 11:05:02','0','Служба Новостей "FM-Продакшн" (Барнаул)','https://vk.com/snfmprod','news','https://pp.vk.me/c630130/v630130300/747/ixUJZFBzy80.jpg','Служба Новостей «FM-Продакшн» - крупнейшее за Уралом информационное агентство, которое обеспечивает новостными выпусками два десятка рейтинговых радиостанций в Алтайском крае',],
            ['24','-85312932','my-altay','news','2017-07-09 11:05:03','0','Мой Алтай','https://vk.com/myaltaicom','news','https://pp.vk.me/c629419/v629419184/47db1/MjuWUSVekn8.jpg','Информационный портал Алтайского края и Республики Алтай',],
            ['25','-56296207','kapitalist_tv','news','2017-07-09 11:05:04','0','Капиталист|Новости Барнаула и Алтайского края','https://vk.com/kapitalist_tv','news','https://pp.vk.me/c630524/v630524963/3ee3/QkgrViv7vSQ.jpg','Алтайский интернет-журнал о бизнесе',],
            ['26','-19227363','politsib','news','2017-07-09 11:06:02','0','ПОЛИТСИБРУ. Доступно о серьезном','https://vk.com/politsibru','news','https://pp.vk.me/c631824/v631824962/3ecda/KrBzvQw_q9I.jpg','Свежие новости #Барнаула и Алтайского края в режиме онлайн. Мнения экспертов в области политики, экономики, бизнеса, культуры и вообще всего, чего угодно.',],
            ['27','-78610701','altai_aif','news','2017-07-09 11:06:02','0','Аргументы и факты - Алтай / altai.aif.ru','https://vk.com/altai_aif','news','https://pp.vk.me/c636331/v636331160/cf76/Zh4GgkQ73qQ.jpg','Присоединяйтесь к нам и будьте в курсе самых интересных и актуальных новостей Барнаула и Алтайского края.',],
            ['28','-23546553','nnews','news','2017-07-09 11:06:02','0','Наши новости и Информационный канал Город','https://vk.com/nnews','news','https://pp.vk.me/c621622/v621622843/50e5e/3lX2PBhBfz4.jpg','Новости Алтая и Барнаула',],
            ['29','-113535804','top_discount','discount','2017-07-09 11:04:02','0','Top Discount (Барнаул)','https://vk.com/top_discount','discount','https://pp.vk.me/c626227/v626227733/275a2/4SkqaCS57aw.jpg','Единая интернет площадка скидок и акций города. Будь с TopDiscount, будь в курсе!',],
        ];

        return $data;
    }
}