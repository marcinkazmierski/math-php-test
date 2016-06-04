<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;


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
            ->add('number', IntegerType::class,
                array(
                    'label' => 'Integer number',
                    'invalid_message' => 'This value is not integer number.',
                    'constraints' => array(
                        new  Range(array('min' => 1, 'max' => $this->maxNumber)),
                        new NotBlank()
                    ),
                ))
            ->add('submit', SubmitType::class, array('label' => 'Calculate'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array());
    }
}