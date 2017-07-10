<?php
namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DashboardController extends BaseController
{
    /**
     * @Route("/", name="admin.dashboard")
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }

}