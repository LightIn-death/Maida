<?php

namespace App\Controller;

use App\Entity\Debt;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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


        $wainting  = $this->getDoctrine()
            ->getRepository(Debt::class)
            ->findByNotAcceptedOwner($this->getUser()->getId());

        return $this->render('debt/index.html.twig', [

            'pending' => $pending,
            'waiting' => $wainting,

        ]);

    }


    /**
     * @Route("/pending/details/{id}", methods={"GET","POST"}, name="details")
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function details(int $id ,Request $request): Response
    {




        $details  = $this->getDoctrine()
            ->getRepository(Debt::class)
            ->find($id);





        $form = $this->createFormBuilder()
            ->add('newAmount', NumberType::class ,['label' => "Ajouter de l'argent   :"])
            ->add('save', SubmitType::class, ['label' => 'Ajouter'])
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();

            $newAmount = $data['newAmount'] <  $details->getAmount() -  $details->getAlreadyRefund() ?  $details->getAlreadyRefund() + $data['newAmount'] : $details->getAlreadyRefund() + ($details->getAmount() -  $details->getAlreadyRefund());


            $details->setAlreadyRefund($newAmount);

            $em->persist($details);

            $em->flush();

        }



        return $this->render('debt/details.html.twig', [

            'details' => $details,
            'formulaire' => $form->createView(),


        ]);

    }


    /**
     * @Route("/pending/delete/{id}", methods={"GET","POST"}, name="delete")
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {



        $details  = $this->getDoctrine()
            ->getRepository(Debt::class)
            ->find($id);


        if($details->getOwner()->getId()  == $this->getUser()->getId()){


            $em = $this->getDoctrine()->getManager();

            $em->remove($details);

            $em->flush();

        }



        return $this->redirectToRoute('pending');

    }
}
