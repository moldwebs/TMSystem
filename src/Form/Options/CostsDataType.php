<?php


namespace App\Form\Options;


use App\Entity\Currency;
use App\Entity\Options\Costs;
use App\Entity\Options\CostsData;

use App\Entity\PayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CostsDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('costs', EntityType::class, [
                'class' => Costs::class,
                'label' => false,
                'row_attr' => array(
                    'class' => 'd-none'
                ),
                'data' => $options['row_attr']['label']
            ])
            ->add('cost', MoneyType::class, [
                'label' => $options['row_attr']['label'],
                'required' => false,
            ])
            ->add('currency', EntityType::class, [
                'class' => Currency::class,
                'label' => 'Currency',
                'required' => false,
                'placeholder' => false
            ])
            ->add('paytype', EntityType::class, [
                'class' => PayType::class,
                'label' => 'Payment Type',
                'required' => false,
                'placeholder' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CostsData::class
        ]);
    }
}
