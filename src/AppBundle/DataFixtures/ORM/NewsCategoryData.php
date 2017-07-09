<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\NewsCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NewsCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $newsCategoryData) {
            $newsCategory = new NewsCategory();
            $newsCategory->setIndentity($newsCategoryData[1]);
            $newsCategory->setTitle($newsCategoryData[0]);

            $manager->persist($newsCategory);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder() : int
    {
        return 1;
    }

    /**
     * @return array
     */
    public function getData() : array
    {
        $data = [
            [
                'Главное',
                'news',
            ],
            [
                'Горячее',
                'different',
            ],
            [
                'Спорт',
                'news_sport',
            ],
            [
                'Путешествия',
                'traveling',
            ],
            [
                'Афиша',
                'afisha',
            ],
            [
                'Животные',
                'animals',
            ],
            [
                'Скидки',
                'discount',
            ],
        ];

        return $data;
    }
}