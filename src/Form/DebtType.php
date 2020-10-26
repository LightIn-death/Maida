<?php

namespace App\Form;

use App\Entity\Debt;
use App\Entity\Personne;
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
            ->add('tempCreditor', EntityType::class, [
                'class' => Personne::class,
                'choice_label' => "firstname",
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('amount')
//            ->add('accepted')
//            ->add('finished')
//            ->add('alreadyRefund')
            ->add('deadline')
            ->add('owner', EntityType::class, [
                'class' => Personne::class,
                'choice_label' => "firstname",
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
