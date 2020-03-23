<?php


namespace App\Form\Options;


use App\Entity\Options\Term;
use App\Entity\Options\Transport;

use App\Form\EntityCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Number'
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'choices' => array_flip(Transport::TYPES)
            ])
            ->add('model', TextType::class, [
                'label' => 'Model',
                'required' => false,
                'property_path' => 'extras[model]',
            ])
            ->add('model_fp', TextType::class, [
                'label' => 'Model FP',
                'required' => false,
                'property_path' => 'extras[model_fp]',
            ])
            ->add('win_code', TextType::class, [
                'label' => 'WIN cod',
                'required' => false,
                'property_path' => 'extras[win_code]',
            ])
            ->add('year', DateType::class, [
                'label' => 'Anul producerii',
                'required' => false,
                'property_path' => 'extras[year]',
                'widget'    => "single_text",
            ])
            ->add('consumption', TextType::class, [
                'label' => 'Consum',
                'required' => false,
                'property_path' => 'extras[consumption]',
            ])
            ->add('tachometer', TextType::class, [
                'label' => 'Kilometraj',
                'required' => false,
                'property_path' => 'extras[tachometer]',
            ])

            ->add('termData', EntityCollectionType::class, [
                'entry_type' => TermDataType::class,
                'class' => Term::class,
                'criteria' => ['type' => 'transport'],
                'orderBy' => ['position' => 'asc'],
                'entry_options' => [
                    'row_attr' => [
                        'class' => 'col-md-2'
                    ]
                ],
                'attr' => [
                    'class' => 'form-row'
                ],
                'label' => false,
            ])

            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transport::class
        ]);
    }
}