<?php

namespace App\Form;

use App\Entity\Options\TermData;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\AbstractType;
use App\EventListener\ResizeFormListener;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityCollectionType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $results = $this->entityManager->getRepository($options['class'])->findBy($options['criteria'], $options['orderBy']);

        $resizeListener = new ResizeFormListener();

        $resizeListener->setConf(
            $options['entry_type'],
            $results,
            $options['entry_options'],
            true
        );

        $builder->addEventSubscriber($resizeListener);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entry_type' => TextType::class,
            'entry_options' => [],
            'delete_empty' => false,
            'class' => null,
            'criteria' => [],
            'orderBy' => [],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'entitycollection';
    }

}
