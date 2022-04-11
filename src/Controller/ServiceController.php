<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service/metier", name="app_service_metier")
     */
    public function index(): Response
    {
        return $this->render('service/metier.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }
}
