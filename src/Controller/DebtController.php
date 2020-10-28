<?php

namespace App\Controller;

use App\Entity\Debt;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DebtController extends AbstractController
{
    /**
     * @Route("/pending", name="pending")
     */
    public function index(): Response
    {





        $pending  = $this->getDoctrine()
            ->getRepository(Debt::class)
            ->findByNotFinished($this->getUser()->getId());




        return $this->render('debt/index.html.twig', [

            'pending' => $pending,

        ]);

    }

}
