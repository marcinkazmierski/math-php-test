<?php

namespace AppBundle\Controller;

use AppBundle\Form\AlgorithmType;
use AppBundle\Service\Algorithm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /** @var $algorithm Algorithm */
        $algorithm = $this->get('app_algorithm');
        $result = $algorithm->calculate(5);
        dump($result);

        $form = $this->createForm(AlgorithmType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }

        //$this->addFlash(
        //    'danger',
        //    $this->get('translator')->trans('app.test')
        //);
        return $this->render('AppBundle::index/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
