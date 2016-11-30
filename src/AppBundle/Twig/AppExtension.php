<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
            new \Twig_SimpleFilter('imgSize', array($this, 'imageSize')),
            new \Twig_SimpleFilter('imgMimeType', array($this, 'imageMimeType')),
            new \Twig_SimpleFilter('filterXMLForYandex', array($this, 'replaceSpecialSymbolsFromXML')),
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    public function imageSize($image_path){
        $size = getimagesize($image_path);
        return $size[0] * $size[1];
    }

    public function imageMimeType($image_path){
        $size = getimagesize($image_path);
        return $size['mime'];
    }

    public function replaceSpecialSymbolsFromXML($str)
    {
        $patterns = array(
            '/&/',
            '/</',
            '/>/',
            '/\'/',
            '/"/',
        );
        $replacements = array(
            '&amp;',
            '&lt;',
            '&gt;',
            '&apos;',
            '&quot;',
        );
        $str = preg_replace($patterns, $replacements, $str);
        return $str;
    }

    public function getName()
    {
        return 'app_extension';
    }
}