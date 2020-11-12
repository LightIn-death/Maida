<?php

namespace App\Controller;


use App\Entity\Debt;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddNewDebtController extends AbstractController
{
    /**
     * @Route("/add", name="add_new_debt")
     * @param Request $request
     * @return Response
     */


    public function index(Request $request): Response
    {


        $form = $this->createFormBuilder()
            ->add('creditors', EntityType::class, [

                'class' => User::class,
                'choice_label' => 'name',
                'multiple' => true,

            ])
            ->add('amount', NumberType::class)
            ->add('deadline', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Créer la dette'])
            ->getForm();

        $form->handleRequest($request);
//        var_dump($form);


        if ($form->isSubmitted() && $form->isValid()) {


            //récupérer l'entity manager (objet qui gère la connection à la BDD)
            $em = $this->getDoctrine()->getManager();


            //je dis au manager que je veux garde l'objet en BDD

            $data = $form->getData();


            $montant = $data["amount"] / count($data["creditors"]);


            foreach (  $data["creditors"] as $e){
//                var_dump($e);

                $debt = new Debt();

                $debt->setOwner($this->getUser());
                $debt->setCreditor($e);
                $debt->setDeadline($data["deadline"]);
                $debt->setAmount($montant);


                $em->persist($debt);



            }

            //je déclenche l'insert
            $em->flush();

            return $this->redirectToRoute('dashboard');
        }


        return $this->render('add_new_debt/index.html.twig', [
            "formulaire" => $form->createView(),
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

