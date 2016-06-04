<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AlgorithmType extends AbstractType
{
    private $maxNumber = 0;

    public function __construct($maxNumber)
    {
        $this->maxNumber = (int)$maxNumber;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numbers', TextareaType::class)
            ->add('submit', SubmitType::class, array('label' => 'Calculate'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array());
    }
}