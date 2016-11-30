<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 14.02.2016
 * Time: 9:50
 */

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use AppBundle\Entity\ViewCounter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class OneNewsController
 * @package AppBundle\Controller
 */
class OneNewsController extends Controller{

    /**
     * Show one news
     * @Route("/news/{gr_news_id}", name="one_news_router")
     * @Template()
     */
    public function indexAction(Request $request, $gr_news_id){
        $em = $this->getDoctrine()->getManager();
        $news_repository = $em->getRepository('AppBundle:News');

        list($group_id, $news_id) = explode('_', $gr_news_id);

        $one_news = $news_repository->getNewsByNewsIdAndVkId($news_id, -$group_id);

        if(!$one_news){
            throw new NotFoundHttpException('Запрашиваемая новость не найдена');
        }

        $counter = new ViewCounter();
        $counter->setNews($one_news);
        $counter->setIp($request->getClientIp());
        $em->persist($counter);
        $em->flush();

        $category = $one_news->getVkGroup()->getGroupTheme();
        return array(
            'news' => $one_news,
            'category_'.$category => $category
        );
    }
}