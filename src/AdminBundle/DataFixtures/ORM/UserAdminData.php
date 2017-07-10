<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Information\AdditionalInfo;
use AppBundle\Entity\News;
use AppBundle\Entity\NewsCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Services\UserManipulator;
use UserBundle\UserBundleServices;
use UserBundle\UserRoles;


class UserAdminData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var UserManipulator $userManipulator */
        $userManipulator = $this->container->get(UserBundleServices::USER_MANIPULATOR);
        $userManipulator->createUser('admin@sibers.com', 11111, 1, UserRoles::ROLE_ADMIN);
    }

    /**
     * @return int
     */
    public function getOrder() : int
    {
        return 1;
    }
}