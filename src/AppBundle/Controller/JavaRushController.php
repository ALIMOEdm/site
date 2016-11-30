<?php
namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsPicture;
use AppBundle\Util\JavaRush;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;


class JavaRushController extends Controller
{
    /**
     * Show java rush site
     *
     * @Route("/java-rush", name="java_rush")
     * @Template()
     */
    public function indexAction(Request $request)
    {
//        $res = file_get_contents("http://javarush.ru/cs50.html");
        // создание нового ресурса cURL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://javarush.ru/cs50.html");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5) ;

        $res = curl_exec($ch);

        $ob = new JavaRush();
        $res = $ob->parse($res);

        curl_close($ch);
        return array(
            'html' => $res,
            'category_java_rush' => 1,
        );
    }
}