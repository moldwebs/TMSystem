<?php


namespace App\Form\Options;


use App\Entity\Options\Route;
use App\Entity\Options\Costs;
use App\Entity\Options\Term;
use App\Form\EntityCollectionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Name'
            ])

            ->add('costsData', EntityCollectionType::class, [
                'entry_type' => CostsDataType::class,
                'class' => Costs::class,
                'criteria' => ['type' => 'routes'],
                'orderBy' => ['position' => 'asc'],
                'entry_options' => [
                    'row_attr' => [
                        'class' => 'col-md-3'
                    ],
                ],
                'attr' => [
                    'class' => 'form-row'
                ],
                'label' => false,
            ])

            ->add('termData', EntityCollectionType::class, [
                'entry_type' => TermDataType::class,
                'class' => Term::class,
                'criteria' => ['type' => 'routes'],
                'orderBy' => ['position' => 'asc'],
                'entry_options' => [
                    'row_attr' => [
                        'class' => 'col-md-3'
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
            'data_class' => Route::class
        ]);
    }
}