<?php

namespace AppBundle\Controller;

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
        var_dump($result);
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
        ]);
    }
}
