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
        $results = '';
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $data = $form->getData();
                if (!empty($data['numbers'])) {
                    $numbers = $data['numbers'];
                    $numbers = preg_split('/\r\n|[\r\n]/', $numbers);

                    /** @var $algorithm Algorithm */
                    $algorithm = $this->get('app_algorithm');

                    foreach ($numbers as $number) {

                        $result = $algorithm->calculate((int)$number);

                        if ($result !== false) {
                            $results .= $result . PHP_EOL;
                        } else {
                            $results .= '-' . PHP_EOL;
                            $this->addFlash(
                                'danger',
                                $this->get('translator')->trans('app.form.validation.something_wrong.%number%',
                                    array('%number%' => $number)
                                )
                            );
                        }
                    }
                } else {
                    $this->addFlash(
                        'danger',
                        $this->get('translator')->trans('app.form.validation.empty_numbers')
                    );
                }
                //return $this->redirectToRoute('homepage');
            } else {
                $this->addFlash(
                    'danger',
                    $this->get('translator')->trans('app.form.validation.something_wrong')
                );
            }
        }

        return $this->render('AppBundle::index/index.html.twig', array(
            'form' => $form->createView(),
            'results' => $results
        ));
    }
}
