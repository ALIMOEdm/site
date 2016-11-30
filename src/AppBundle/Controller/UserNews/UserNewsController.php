<?php

namespace AppBundle\Controller\UserNews;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\UserNews\UserNews;
use AppBundle\Form\userNewsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * UserNews controller.
 *
 * @Route("/user-news")
 */
class UserNewsController extends Controller
{
    /**
     * Lists all userNews entities.
     *
     * @Route("/", name="usernews_usernews_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userNews = $em->getRepository('AppBundle:UserNews\UserNews')->findAll();

        return  array(
            'userNews' => $userNews,
        );
    }

    /**
     * Creates a new userNews entity.
     *
     * @Route("/new", name="usernews_usernews_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $userNews = new UserNews();
        $form = $this->createForm('AppBundle\Form\UserNews\UserNewsType', $userNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userNews);
            $em->flush();

            return $this->redirectToRoute('usernews_usernews_show', array('id' => $userNews->getId()));
        }

        return array(
            'userNews' => $userNews,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a userNews entity.
     *
     * @Route("/{id}", name="usernews_usernews_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(UserNews $userNews)
    {
        $deleteForm = $this->createDeleteForm($userNews);

        return array(
            'userNews' => $userNews,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing userNews entity.
     *
     * @Route("/{id}/edit", name="usernews_usernews_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, UserNews $userNews)
    {
        $deleteForm = $this->createDeleteForm($userNews);
        $editForm = $this->createForm('AppBundle\Form\UserNews\UserNewsType', $userNews);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userNews);
            $em->flush();

            return $this->redirectToRoute('usernews_usernews_edit', array('id' => $userNews->getId()));
        }

        return array(
            'userNews' => $userNews,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a userNews entity.
     *
     * @Route("/{id}", name="usernews_usernews_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserNews $userNews)
    {
        $form = $this->createDeleteForm($userNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userNews);
            $em->flush();
        }

        return $this->redirectToRoute('usernews_usernews_index');
    }

    /**
     * Creates a form to delete a userNews entity.
     *
     * @param UserNews $userNews The userNews entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserNews $userNews)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usernews_usernews_delete', array('id' => $userNews->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
