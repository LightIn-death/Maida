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
            ->findByNotAccepted($this->getUser()->getId());

        return $this->render('debt/index.html.twig', [

            'pending' => $pending,

        ]);

    }


    /**
     * @Route("/pending/details/{id}", methods={"GET","HEAD"}, name="details")
     * @param int $id
     * @return Response
     */
    public function details(int $id): Response
    {

        $details  = $this->getDoctrine()
            ->getRepository(Debt::class)
            ->find($id);

        return $this->render('debt/details.html.twig', [

            'details' => $details,

        ]);

    }
}
