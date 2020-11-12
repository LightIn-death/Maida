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
     * @Route("/dettes", name="dettes")
     */
    public function index(): Response
    {

        $toReimbruse  = $this->getDoctrine()
            ->getRepository(Debt::class)
            ->findByToPay($this->getUser()->getId());

        $waiting  = $this->getDoctrine()
            ->getRepository(Debt::class)
            ->findByGetPaid($this->getUser()->getId());

        $toValidate  = $this->getDoctrine()
            ->getRepository(Debt::class)
            ->findByNotAccepted($this->getUser()->getId());

        return $this->render('debt/index.html.twig', [

            'toReimburse' => $toReimbruse,
            'waiting' => $waiting,
            'toValidate' => $toValidate,

        ]);

    }


    /**
     * @Route("/dettes/details/{id}", methods={"GET","POST"}, name="details")
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
            ->add('newAmount', NumberType::class ,['label' => "Payer un montant : "])
            ->add('save', SubmitType::class, ['label' => 'Payer'])
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
     * @Route("/dettes/delete/{id}", methods={"GET","POST"}, name="delete")
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
        return $this->redirectToRoute('dettes');
    }

    /**
     * @Route("/dettes/validate/{id}", methods={"GET","POST"}, name="validate")
     * @param int $id
     * @return Response
     */
    public function validate(int $id): Response
    {
        $details  = $this->getDoctrine()
            ->getRepository(Debt::class)
            ->find($id);

        if($details->getCreditor()->getId()  == $this->getUser()->getId()){

            $em = $this->getDoctrine()->getManager();

            $details->setAccepted('1');

            $em->flush();

        }
        return $this->redirectToRoute('dettes');
    }
}
