<?php

namespace App\Controller;

use App\Form\ContactType;

use App\Entity\Contact;
use App\Entity\Portfolio;
use App\Repository\ContactRepository;
use App\Repository\PortfolioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home", methods={"GET", "POST"})
     */
    public function index(PortfolioRepository $portfolioRepository, ContactRepository $contactRepository, Request $request): Response
    {

        $portfolios = $portfolioRepository -> findAll();

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'portfolios' => $portfolios,
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }
}
