<?php


namespace App\Form\Options;


use App\Entity\Options\Term;
use App\Entity\Options\TermData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TermDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('term', EntityType::class, [
                'class' => Term::class,
                'label' => false,
                'row_attr' => array(
                    'class' => 'd-none'
                )
            ])
            ->add('date', DateType::class, [
                'label' => $options['row_attr']['label'],
                'required' => false,
                'widget'    => "single_text",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TermData::class
        ]);
    }
}