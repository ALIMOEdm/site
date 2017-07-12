<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\NewsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\News;

/**
 * News controller.
 *
 * @Route("/news")
 */
class NewsController extends Controller
{
    /**
     * Lists all News entities.
     *
     * @Route("/{page}", name="admin.news.index", requirements={
     *     "page": "\d+"
     * })
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository(News::class)->getListOfNewsQuery('', '', []);

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', $page)/*page number*/,
            $this->getParameter('number_of_article_on_main_page')/*limit per page*/
        );

        if(count($entities)){
            if(is_array($entities[0])){
                $temp = array();
                foreach($entities->getItems() as $ent){
                    $e = $ent[0];
//                    $e = $this->setAdditionalFiledToSkin($ent, $e);
                    $temp[] = $e;
                }
                $entities->setItems($temp);
            }
        }

        return [
            'news' => $entities,
        ];
    }

    /**
     * Creates a new News entity.
     *
     * @Route("/new", name="admin.news.new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('admin.news.show', array('id' => $news->getId()));
        }

        return [
            'news' => $news,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a News entity.
     *
     * @Route("/{id}", name="admin.news.show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(News $news)
    {
        $deleteForm = $this->createDeleteForm($news);

        return [
            'news' => $news,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     * @Route("/{id}/edit", name="admin.news.edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, News $news)
    {
        $deleteForm = $this->createDeleteForm($news);
        $editForm = $this->createForm(NewsType::class, $news);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('admin.news.edit', array('id' => $news->getId()));
        }

        return [
            'news' => $news,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a News entity.
     *
     * @Route("/{id}", name="admin.news.delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, News $news)
    {
        $form = $this->createDeleteForm($news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($news);
            $em->flush();
        }

        return $this->redirectToRoute('admin.news.index');
    }

    /**
     * Creates a form to delete a News entity.
     *
     * @param News $news The News entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(News $news)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin.news.delete', array('id' => $news->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
