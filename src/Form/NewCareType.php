<?php

namespace App\Form;

use App\Entity\Care;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewCareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                "constraints" => [
                    new NotBlank([
                        'message' => 'Ne peut être nul.'
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Maximum {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                "required" => false,
                'attr' => [
                    'rows' => 5
                ],
                'label' => 'Description (Facultative)'
            ])
            ->add('price', IntegerType::class, [
                "constraints" => [
                    new NotBlank([
                        'message' => 'Ne peut être nul.'
                    ])
                ]
            ])
            ->add('length', IntegerType::class, [
                "constraints" => [
                    new NotBlank([
                        'message' => 'Ne peut être nul.'
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer un soin'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Care::class,
        ]);
    }
}
