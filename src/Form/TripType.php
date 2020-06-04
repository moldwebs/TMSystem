<?php


namespace App\Form;


use App\Entity\Options\Costs;
use App\Entity\Options\Driver;
use App\Entity\Options\Route;
use App\Entity\Options\Transport;
use App\Entity\Trip;

use App\Form\Options\CostsDataType;
use App\Repository\RouteRepository;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{

    private $tripRepository;
    private $routeRepository;

    public function __construct(TripRepository $tripRepository, RouteRepository $routeRepository)
    {
        $this->tripRepository = $tripRepository;
        $this->routeRepository = $routeRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', TextType::class, [
                'label' => 'Number'
            ])
            ->add('route', EntityType::class, [
                'class' => Route::class,
                'label' => 'Route',
                'placeholder' => '',
                'attr' => [
                    'class' => 'select2',
                    'js-change-load' => '#trip_driver #trip_transport #trip_withTransport #trip_placeFrom #trip_placeTo #trip_costsData'
                ]
            ])
            ->add('transport', EntityType::class, [
                'class' => Transport::class,
                'label' => 'Transport',
                'placeholder' => '',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('withTransport', EntityType::class, [
                'class' => Transport::class,
                'required' => false,
                'label' => 'With Transport',
                'placeholder' => '',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('driver', EntityType::class, [
                'class' => Driver::class,
                'label' => 'Driver',
                'placeholder' => '',
                'attr' => [
                    'class' => 'select2'
                ]
            ])

            ->add('placeFrom', TextType::class, [
                'label' => 'From place'
            ])

            ->add('placeTo', TextType::class, [
                'label' => 'To place'
            ])

            ->add('releaseDate', DateType::class, [
                'label' => 'Release Date',
                'widget'    => "single_text",
            ])

            ->add('startDate', DateType::class, [
                'label' => 'Start Date',
                'widget'    => "single_text",
            ])

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $form = $event->getForm();
                /** @var Trip $data */
                $data = $event->getData();

                if (!$data->getId()) {
                    $maxNumber = (int) $this->tripRepository->getMaxNumber();
                    $data->setNumber(++$maxNumber);
                }

                if (!$data->getId()) {
                    $data->setStartDate((new \DateTime())->modify("+1 day"));
                    $data->setReleaseDate(new \DateTime());
                }

                if (!empty($_GET['trip']['route'])) {
                    $route = $this->routeRepository->find($_GET['trip']['route']);

                    $data->setCostsData($route->getCostsData());

                    if ($trip = $this->tripRepository->getLast($route)) {
                        $data = $trip;
                    }

                }

                $event->setData($data);

                $form->add('costsData', EntityCollectionType::class, [
                    'entry_type' => CostsDataType::class,
                    'class' => Costs::class,
                    'criteria' => ['type' => 'routes'],
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

//                $form->add('costsData', CollectionType::class, [
//                    'entry_type' => CostsDataType::class,
//                    'entry_options' => ['label' => false, 'row_attr' => ['label' => 'ok']],
//                    'allow_add' => true,
//                    'allow_delete' => true,
//                    'by_reference' => false,
//                ])

                ;

                $form->add('save', SubmitType::class);

            })

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class
        ]);
    }
}
