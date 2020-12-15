<?php

namespace App\Controller;

use App\Entity\Portfolio;
use App\Repository\PortfolioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(PortfolioRepository $portfolioRepository): Response
    {
        $portfolios = $portfolioRepository -> findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'portfolios' => $portfolios,
        ]);
    }
}
