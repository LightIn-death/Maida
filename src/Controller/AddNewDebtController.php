<?php

namespace App\Controller;


use App\Entity\Debt;
use App\Form\DebtType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;





class AddNewDebtController extends AbstractController
{
    /**
     * @Route("/add", name="add_new_debt")
     * @param Request $request
     * @return Response
     */





    public function index(Request $request): Response
    {
        //créer une catégorie vide
        $debt = new Debt();


        //créer le formulaire
        $form = $this->createForm(DebtType::class, $debt);


        $form->handleRequest($request);
//        var_dump($debt);


        var_dump($debt);
        if ($form->isSubmitted() && $form->isValid()) {


            //récupérer l'entity manager (objet qui gère la connection à la BDD)
            $em = $this->getDoctrine()->getManager();




            //je dis au manager que je veux garde l'objet en BDD
            $em->persist($debt);


            //je déclenche l'insert
            $em->flush();


            return $this->redirectToRoute('dashboard');

        }


        return $this->render('add_new_debt/index.html.twig', [
            "formulaire" => $form->createView()
        ]);
    }


}










//        if (array_key_exists("debt", $request->request->all())) {


//
//            $request->request->set("test", "test2");
//            var_dump($request->request->all()/*["debt"]*/);
//            $detes = $request->request->all()["debt"];
//            $creantier = $detes["creditor"];
//
//
//            var_dump($creantier);
//            $detes["amount"] /= count($creantier);
//
//
//            echo "<br>";
//            foreach ($creantier as $c) {
//
//
//
//
//
//
//
//
//                $detes["creditor"] = $c;
//                echo "<br>" ;
//
//                var_dump($detes);
//                $request->request->set("debt", $detes);
//
//
//                echo "<br>";
//                var_dump($request->request->all()["debt"]);
//                //gérer le retour du POST
//                $form->handleRequest($request);
//
//                if ($form->isSubmitted() && $form->isValid()) {
//
//
//                    //récupérer l'entity manager (objet qui gère la connection à la BDD)
//                    $em = $this->getDoctrine()->getManager();
//
//
//                    echo "Var Dump de dept : ";
//                    var_dump($debt);
//                    //je dis au manager que je veux garde l'objet en BDD
//                    $em->persist($debt);
//
//
//                    //je déclenche l'insert
//                    $em->flush();
//
//
//                }
//
//
//            }
//je vais à la liste des catégories
//            return $this->redirectToRoute('dashboard');

