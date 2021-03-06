<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Information\AdditionalInfo;
use AppBundle\Entity\News;
use AppBundle\Entity\NewsCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AdditionalInfoData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData($manager) as $additionalInfoData) {
            $additionalInfo = new AdditionalInfo();
            $additionalInfo->setParamName($additionalInfoData[0]);
            $additionalInfo->setParamValue($additionalInfoData[1]);

            $manager->persist($additionalInfo);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder() : int
    {
        return 4;
    }

    /**
     * @return array
     */
    public function getData(ObjectManager $manager) : array
    {
        /** @var News[] $news */
        $news = $manager->getRepository(News::class)->findAll();
        $data = [
            [
                'USD',
                '60.38',
            ],
            [
                'EUR',
                '68.95',
            ],
            [
                'celebrate',
                'День российской почты',
            ],
            [
                'temperature',
                '21.666666666667',
            ],
            [
                'wind_speed',
                '3.12928',
            ],
            [
                'humidity',
                '60',
            ],
            [
                'visibility',
                '16.1',
            ],
            [
                'popular_news',
                implode(',', [$news[0]->getId(),$news[2]->getId(),$news[33]->getId()]),
            ],
        ];

        return $data;
    }
}