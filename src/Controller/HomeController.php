<?php

namespace App\Controller;
use App\Entity\Metier;
use App\Repository\MetierRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

   

 /**
     * @Route("/", name="app_home")
     */
    public function allmetier(Request $request): Response
    {
        $metiers = $this->getDoctrine()->getRepository(Metier::class)->findAll();
        
       
        return $this->render('home/index.html.twig', ["metiers" => $metiers]);
    }


    /**
     * @Route("/list/{id}", name="app_list")
     */
    
    public function listetravailleurParmetier($id): Response
    {
        $metier=$this->getDoctrine()->getRepository(Metier::class)->find($id) ;
        $travailleurs= $metier->getTravailleurs();
        return $this->render('home/jj.html.twig', ["travailleurs" => $travailleurs]);
    }







    
}
