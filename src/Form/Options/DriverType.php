<?php


namespace App\Form\Options;


use App\Entity\Options\Driver;
use App\Entity\Options\Term;
use App\Entity\Options\TermData;
use App\Form\EntityCollectionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Name'
            ])
            ->add('nr_matricol', TextType::class, [
                'label' => 'Numar matricol',
                'required' => false,
                'property_path' => 'extras[nr_matricol]',
            ])
            ->add('idnp', TextType::class, [
                'label' => 'IDNP',
                'required' => false,
                'property_path' => 'extras[idnp]',
            ])
            ->add('date_born', DateType::class, [
                'label' => 'Data nasterii',
                'required' => false,
                'property_path' => 'extras[date_born]',
                'widget'    => "single_text",
            ])

            ->add('termData', EntityCollectionType::class, [
                'entry_type' => TermDataType::class,
                'class' => Term::class,
                'criteria' => ['type' => 'drivers'],
                'orderBy' => ['position' => 'asc'],
                'entry_options' => [
                    'row_attr' => [
                        'class' => 'col-md-2'
                    ],
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
            'data_class' => Driver::class
        ]);
    }
}
