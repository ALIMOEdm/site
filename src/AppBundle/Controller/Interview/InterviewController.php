<?php
namespace AppBundle\Controller\Interview;

use AppBundle\Controller\Controller;
use AppBundle\Entity\Interview\Interview;
use AppBundle\Form\Interview\InterviewType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class InterviewController extends Controller{

    /**
     * @Route("/interview", name="interview")
     * @Template()
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        $interview = new Interview();
        $form = $this->createForm(new InterviewType(), $interview);
        $form->handleRequest($request);

        if ($form->isValid()) {

        }

        return array(
            'form' => $form->createView()
        );
    }

}