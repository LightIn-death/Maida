<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddNewDebtController extends AbstractController
{
    /**
     * @Route("/add/new/debt", name="add_new_debt")
     */
    public function index(): Response
    {
        return $this->render('add_new_debt/index.html.twig', [
            'controller_name' => 'AddNewDebtController',
        ]);
    }
}
