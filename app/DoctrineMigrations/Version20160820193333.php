<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160820193333 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
                UPDATE vkgroup SET logo="https://pp.vk.me/c629125/v629125283/322f5/s1CanfOFUuQ.jpg", description="Узнавай о происшествиях и событиях моментально!" WHERE group_name="amic";
                UPDATE vkgroup SET logo="https://pp.vk.me/c627427/v627427762/3f0b6/GCcsy0vzlyw.jpg", description="Новости Алтайского края" WHERE group_name="altapress";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630224/v630224351/2918b/RUyplAJMVIM.jpg", description="ТОП новости. Видео материалы, фото коллекции, анонсы крупных Барнаульских авто тем, соревнований, шоу, выставок и т.д. 18+" WHERE group_name="barnaul22";
                UPDATE vkgroup SET logo="", description="" WHERE group_name="tp_barnaul";
                UPDATE vkgroup SET logo="https://pp.vk.me/c410920/v410920752/dae1/WFAPrNHsHLE.jpg", description="Новости Алтая и Барнаула" WHERE group_name="alt_brn_news";
                UPDATE vkgroup SET logo="https://pp.vk.me/c629422/v629422287/30b68/P9OPsgFjjjc.jpg", description="Новости алтайского спорта, актуальные репортажи с места событий, красочные фотографии, аналитические материалы" WHERE group_name="alt_sport";
                UPDATE vkgroup SET logo="https://pp.vk.me/c604520/v604520271/10b02/GduSyHo5dBI.jpg", description="Барнаулец? Заходи!" WHERE group_name="i_live_barnaul";
                UPDATE vkgroup SET logo="https://pp.vk.me/c633518/v633518731/ac41/3XP2_PInFNo.jpg", description="Новости Алтая и Барнаула" WHERE group_name="barnauls";
                UPDATE vkgroup SET logo="https://pp.vk.me/c618722/v618722909/1b031/fL7lnnF7gxk.jpg", description="Новости Барнаула, Алтайского края" WHERE group_name="alt_pravda";
                UPDATE vkgroup SET logo="https://pp.vk.me/c629117/v629117467/33a09/e4PeEmw1JDk.jpg", description="Паблик о путешествиях по Алтаю" WHERE group_name="alta_traveling";
                UPDATE vkgroup SET logo="https://pp.vk.me/c617924/v617924651/c2ef/qOuEY2Tbc98.jpg", description="Новости Алтая и Барнаула" WHERE group_name="vizit_altay";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630226/v630226860/36f76/wsuFXe5mZaE.jpg", description="Каталог гостевых домов, усадьбы, коттеджи, небольшие базы отдыха" WHERE group_name="gotoaltay";
                UPDATE vkgroup SET logo="https://pp.vk.me/c629326/v629326300/1abcf/dvroOvbLf48.jpg", description="Новости алтайского спорта" WHERE group_name="sport_fm";
                UPDATE vkgroup SET logo="https://pp.vk.me/c622318/v622318361/56809/cQXkYqTub2g.jpg", description="Весь Барнаул как на ладони! Анонсы мероприятий, афиша, городские новости, много интересной информации о городе, все, чем дышит Барнаул!" WHERE group_name="news_barneo_afisha";
                UPDATE vkgroup SET logo="http://s.rest22.ru/i/rest22-logo.gif", description=" Афиша Барнаула и журнал о культурной жизни города. Смотрите,; слушайте, участвуйте! Отдыхайте интересно!" WHERE group_name="afiha_brn";
                UPDATE vkgroup SET logo="", description="" WHERE group_name="power_brn";
                UPDATE vkgroup SET logo="https://pp.vk.me/c636319/v636319547/206f3/Bbahn03KnIg.jpg", description="Лучше маленькая помощь, чем большое сочувствие!" WHERE group_name="laska_brn";
                UPDATE vkgroup SET group_name="kult_pohod" WHERE group_id="-15495672";
                UPDATE vkgroup SET logo="https://pp.vk.me/c617417/v617417732/143ca/VwRY1N4fAJU.jpg", description="Новые места, персоны и события твоего города" WHERE group_name="kult_pohod";
                UPDATE vkgroup SET logo="https://pp.vk.me/c625520/v625520472/50d2c/NQvJLRXgSpY.jpg", description="Городской журнал: новости и истории" WHERE group_name="barnaulfm";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630824/v630824931/2eb97/r-P2ss3hSKs.jpg", description="Новости Алтая и Барнаула" WHERE group_name="kp_barnaul";
                UPDATE vkgroup SET logo="https://pp.vk.me/c633918/v633918218/33367/UPsk0RUdP0E.jpg", description="Наша группа создана с целью помочь жителям города Барнаула совершать выгодные покупки и экономить деньги на приобретении всевозможных товаров" WHERE group_name="skidki_brn";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630130/v630130300/747/ixUJZFBzy80.jpg", description="Служба Новостей «FM-Продакшн» - крупнейшее за Уралом информационное агентство, которое обеспечивает новостными выпусками два десятка рейтинговых радиостанций в Алтайском крае" WHERE group_name="fm-prodakshn";
                UPDATE vkgroup SET logo="https://pp.vk.me/c629419/v629419184/47db1/MjuWUSVekn8.jpg", description="Информационный портал Алтайского края и Республики Алтай" WHERE group_name="my-altay";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630524/v630524963/3ee3/QkgrViv7vSQ.jpg", description="Алтайский интернет-журнал о бизнесе" WHERE group_name="kapitalist_tv";
                UPDATE vkgroup SET logo="https://pp.vk.me/c631824/v631824962/3ecda/KrBzvQw_q9I.jpg", description="Свежие новости #Барнаула и Алтайского края в режиме онлайн. Мнения экспертов в области политики,экономики, бизнеса,культуры и вообще всего, чего угодно." WHERE group_name="politsib";
                UPDATE vkgroup SET logo="https://pp.vk.me/c636331/v636331160/cf76/Zh4GgkQ73qQ.jpg", description="Присоединяйтесь к нам и будьте в курсе самых интересных и актуальных новостей Барнаула и Алтайского края." WHERE group_name="altai_aif";
                UPDATE vkgroup SET logo="https://pp.vk.me/c621622/v621622843/50e5e/3lX2PBhBfz4.jpg", description="Новости Алтая и Барнаула" WHERE group_name="nnews";
                ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
            UPDATE vkgroup SET logo="https://pp.vk.me/c629125/v629125283/322f5/s1CanfOFUuQ.jpg", description="Узнавай о происшествиях и событиях моментально!" WHERE group_name="amic";
                UPDATE vkgroup SET logo="https://pp.vk.me/c627427/v627427762/3f0b6/GCcsy0vzlyw.jpg", description="Новости Алтайского края" WHERE group_name="altapress";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630224/v630224351/2918b/RUyplAJMVIM.jpg", description="ТОП новости. Видео материалы, фото коллекции, анонсы крупных Барнаульских авто тем, соревнований, шоу, выставок и т.д. 18+" WHERE group_name="barnaul22";
                UPDATE vkgroup SET logo="", description="" WHERE group_name="tp_barnaul";
                UPDATE vkgroup SET logo="https://pp.vk.me/c410920/v410920752/dae1/WFAPrNHsHLE.jpg", description="Новости Алтая и Барнаула" WHERE group_name="alt_brn_news";
                UPDATE vkgroup SET logo="https://pp.vk.me/c629422/v629422287/30b68/P9OPsgFjjjc.jpg", description="Новости алтайского спорта, актуальные репортажи с места событий, красочные фотографии, аналитические материалы" WHERE group_name="alt_sport";
                UPDATE vkgroup SET logo="https://pp.vk.me/c604520/v604520271/10b02/GduSyHo5dBI.jpg", description="Барнаулец? Заходи!" WHERE group_name="i_live_barnaul";
                UPDATE vkgroup SET logo="https://pp.vk.me/c633518/v633518731/ac41/3XP2_PInFNo.jpg", description="Новости Алтая и Барнаула" WHERE group_name="barnauls";
                UPDATE vkgroup SET logo="https://pp.vk.me/c618722/v618722909/1b031/fL7lnnF7gxk.jpg", description="Новости Барнаула, Алтайского края" WHERE group_name="alt_pravda";
                UPDATE vkgroup SET logo="https://pp.vk.me/c629117/v629117467/33a09/e4PeEmw1JDk.jpg", description="Паблик о путешествиях по Алтаю" WHERE group_name="alta_traveling";
                UPDATE vkgroup SET logo="https://pp.vk.me/c617924/v617924651/c2ef/qOuEY2Tbc98.jpg", description="Новости Алтая и Барнаула" WHERE group_name="vizit_altay";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630226/v630226860/36f76/wsuFXe5mZaE.jpg", description="Каталог гостевых домов, усадьбы, коттеджи, небольшие базы отдыха" WHERE group_name="gotoaltay";
                UPDATE vkgroup SET logo="https://pp.vk.me/c629326/v629326300/1abcf/dvroOvbLf48.jpg", description="Новости алтайского спорта" WHERE group_name="sport_fm";
                UPDATE vkgroup SET logo="https://pp.vk.me/c622318/v622318361/56809/cQXkYqTub2g.jpg", description="Весь Барнаул как на ладони! Анонсы мероприятий, афиша, городские новости, много интересной информации о городе, все, чем дышит Барнаул!" WHERE group_name="news_barneo_afisha";
                UPDATE vkgroup SET logo="http://s.rest22.ru/i/rest22-logo.gif", description=" Афиша Барнаула и журнал о культурной жизни города. Смотрите,; слушайте, участвуйте! Отдыхайте интересно!" WHERE group_name="afiha_brn";
                UPDATE vkgroup SET logo="", description="" WHERE group_name="power_brn";
                UPDATE vkgroup SET logo="https://pp.vk.me/c636319/v636319547/206f3/Bbahn03KnIg.jpg", description="Лучше маленькая помощь, чем большое сочувствие!" WHERE group_name="laska_brn";
                UPDATE vkgroup SET group_name="kult_pohod" WHERE group_id="-15495672";
                UPDATE vkgroup SET logo="https://pp.vk.me/c617417/v617417732/143ca/VwRY1N4fAJU.jpg", description="Новые места, персоны и события твоего города" WHERE group_name="kult_pohod";
                UPDATE vkgroup SET logo="https://pp.vk.me/c625520/v625520472/50d2c/NQvJLRXgSpY.jpg", description="Городской журнал: новости и истории" WHERE group_name="barnaulfm";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630824/v630824931/2eb97/r-P2ss3hSKs.jpg", description="Новости Алтая и Барнаула" WHERE group_name="kp_barnaul";
                UPDATE vkgroup SET logo="https://pp.vk.me/c633918/v633918218/33367/UPsk0RUdP0E.jpg", description="Наша группа создана с целью помочь жителям города Барнаула совершать выгодные покупки и экономить деньги на приобретении всевозможных товаров" WHERE group_name="skidki_brn";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630130/v630130300/747/ixUJZFBzy80.jpg", description="Служба Новостей «FM-Продакшн» - крупнейшее за Уралом информационное агентство, которое обеспечивает новостными выпусками два десятка рейтинговых радиостанций в Алтайском крае" WHERE group_name="fm-prodakshn";
                UPDATE vkgroup SET logo="https://pp.vk.me/c629419/v629419184/47db1/MjuWUSVekn8.jpg", description="Информационный портал Алтайского края и Республики Алтай" WHERE group_name="my-altay";
                UPDATE vkgroup SET logo="https://pp.vk.me/c630524/v630524963/3ee3/QkgrViv7vSQ.jpg", description="Алтайский интернет-журнал о бизнесе" WHERE group_name="kapitalist_tv";
                UPDATE vkgroup SET logo="https://pp.vk.me/c631824/v631824962/3ecda/KrBzvQw_q9I.jpg", description="Свежие новости #Барнаула и Алтайского края в режиме онлайн. Мнения экспертов в области политики,экономики, бизнеса,культуры и вообще всего, чего угодно." WHERE group_name="politsib";
                UPDATE vkgroup SET logo="https://pp.vk.me/c636331/v636331160/cf76/Zh4GgkQ73qQ.jpg", description="Присоединяйтесь к нам и будьте в курсе самых интересных и актуальных новостей Барнаула и Алтайского края." WHERE group_name="altai_aif";
                UPDATE vkgroup SET logo="https://pp.vk.me/c621622/v621622843/50e5e/3lX2PBhBfz4.jpg", description="Новости Алтая и Барнаула" WHERE group_name="nnews";
        ');
    }
}
