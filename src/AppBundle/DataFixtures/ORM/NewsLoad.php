<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsCategory;
use AppBundle\Entity\VKGroup;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class NewsLoad extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData($manager) as $newsData) {
            $news = new News();
            $news->setNewsText($newsData['news_text']);
            $news->setNewsId($newsData['news_id']);
            $news->setNewsDate($newsData['news_date']);
            $news->setNewsTitle($newsData['news_title']);
            $news->setNewsDescription($newsData['news_description']);
            $news->setNewsSiteLink($newsData['news_site_link']);
            $news->setNewsVkLink($newsData['news_vk_link']);
            $news->setVkGroup($newsData['vk_group_id']);
            $news->setNewsTextParsed($newsData['news_text_parsed']);
            $news->setCreatedAt($newsData['created_at']);
            $news->setUpdatedAt($newsData['updated_at']);
            $news->setNewsDateTime($newsData['news_date_time']);
            $news->setNewsTextOrigin($newsData['news_text_origin']);
            $news->setDeleted($newsData['deleted']);
            $news->setCategory($newsData['category_id']);
            $news->setSlug($newsData['slug']);

            $manager->persist($news);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 3;
    }

    /**
     * @param ObjectManager $manager
     *
     * @return array
     */
    public function getData(ObjectManager $manager)
    {
        $faker = Factory::create();

        /** @var VKGroup[] $VKGroups */
        $VKGroups = $manager->getRepository(VKGroup::class)->findBy(['deleted' => 0]);

        $data = [];
        $counter = 0;
        while (true) {
            $temp = [];
            /** @var VKGroup vkGroup */
            $vkGroup = $faker->randomElement($VKGroups);
            $temp['news_text'] = $faker->text(1000);
            $temp['news_id'] = $faker->numberBetween(1, 1000000);
            $temp['news_date'] = (new \DateTime())->getTimestamp();
            $temp['news_title'] = $faker->title;
            $temp['news_description'] = $faker->text(400);
            $temp['news_site_link'] = $faker->url;
            $temp['news_vk_link'] = $faker->url;
            $temp['vk_group_id'] = $vkGroup;
            $temp['news_text_parsed'] = $faker->text(1000);
            $temp['created_at'] = new \DateTime();
            $temp['updated_at'] = new \DateTime();
            $temp['news_date_time'] = new \DateTime();
            $temp['news_text_origin'] = $faker->text(1000);
            $temp['deleted'] = 0;
            $temp['category_id'] = $vkGroup->getCategory();
            $temp['slug'] = $faker->slug(4);

            $data[] = $temp;

            if ($counter > 100) {
                break;
            }

            $counter++;
        }

        return $data;
    }
}