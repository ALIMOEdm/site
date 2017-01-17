<?php
namespace AppBundle\Services;


class SiteMap
{
    protected $sitemap_path;

    public function __construct($sitemap_path)
    {
        $this->sitemap_path = $sitemap_path;
    }

    public function addToSiteMap($url)
    {
        $doc = new \DOMDocument();
        $doc->load($this->sitemap_path);

        $url_element = $doc->createElement('url');
        $loc_element = $doc->createElement('loc');
        $text_element = $doc->createTextNode($url);
        $loc_element->appendChild($text_element);
        $url_element->appendChild($loc_element);
        $doc->appendChild($url_element);
        $url_set_elems = $doc->getElementsByTagName('urlset');

        if ($url_set_elems->length) {
            $url_set_elems->item(0)->appendChild($url_element);
        }

        $elems = $doc->getElementsByTagName('lastmod');


        if ($elems->length) {
            $elems->item(0)->childNodes->item(0)->nodeValue = (new \DateTime())->format('Y-m-d');
        }

        $doc->save($this->sitemap_path);
    }
}