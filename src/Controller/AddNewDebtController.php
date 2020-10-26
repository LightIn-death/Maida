<?php

namespace App\Controller;


use App\Form\DebtType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AddNewDebtController extends AbstractController
{
    /**
     * @Route("/add/new/debt", name="add_new_debt")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        //créer une catégorie vide
//        $debt = new Debt();

        $debt = null;


        //créer le formulaire
        $form = $this->createForm(DebtType::class, $debt);


        if(array_key_exists("debt",$request->request->all())){

            var_dump($request->request->all()["debt"]);
            $detes = $request->request->all()["debt"];
            $montant = $detes["amount"];
            $creantier = $detes["creditor"];
            $montant /= count($creantier);

        }




        //gérer le retour du POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            //récupérer l'entity manager (objet qui gère la connection à la BDD)
            $em = $this->getDoctrine()->getManager();

            //je dis au manager que je veux garde l'objet en BDD
            $em->persist($debt);


            //je déclenche l'insert
            $em->flush();

            //je vais à la liste des catégories
            return $this->redirectToRoute('dashboard');
        }


        return $this->render('add_new_debt/index.html.twig', [
            "formulaire" => $form->createView()
        ]);
    }


}
