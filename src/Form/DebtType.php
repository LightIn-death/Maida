<?php

namespace App\Form;

use App\Entity\Debt;
use App\Entity\Personne;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DebtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('creditor', EntityType::class, [
                'class' => User::class,
                'choice_label' => "name",
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('amount')
//            ->add('accepted')
//            ->add('finished')
//            ->add('alreadyRefund')
            ->add('deadline')
            ->add('owner', EntityType::class, [
                'class' => User::class,
                'choice_label' => "name",
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('OK', SubmitType::class, [
                'label' => "Enregistrer"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Debt::class,
        ]);
    }
}
