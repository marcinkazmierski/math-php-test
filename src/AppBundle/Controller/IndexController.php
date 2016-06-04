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
        $form = $this->createForm(AlgorithmType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {

                $data = $form->getData();
                if (!empty($data['number'])) {
                    $number = (int)$data['number'];

                    /** @var $algorithm Algorithm */
                    $algorithm = $this->get('app_algorithm');
                    $result = $algorithm->calculate($number);
                    if ($result !== false) {
                        $this->addFlash(
                            'success',
                            $this->get('translator')->trans('app.form.validation.success_result.%result%',
                                array('%result%' => $result))
                        );
                    } else {
                        $this->addFlash(
                            'danger',
                            $this->get('translator')->trans('app.form.validation.something_wrong')
                        );
                    }
                } else {
                    $this->addFlash(
                        'danger',
                        $this->get('translator')->trans('app.form.validation.empty_number')
                    );
                }
                return $this->redirectToRoute('homepage');
            } else {
                $this->addFlash(
                    'danger',
                    $this->get('translator')->trans('app.form.validation.something_wrong')
                );
            }
        }

        return $this->render('AppBundle::index/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
