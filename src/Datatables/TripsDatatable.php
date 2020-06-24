<?php


namespace App\Datatables;


use App\Entity\Trip;

use App\Datatables\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\DateTimeColumn;
use Sg\DatatablesBundle\Datatable\Editable\TextEditable;
use Sg\DatatablesBundle\Datatable\Filter\DateRangeFilter;
use Sg\DatatablesBundle\Datatable\Filter\SelectFilter;

class TripsDatatable extends AbstractDatatable
{

    public function getLineFormatter()
    {
        $formatter = function ($line) {
            $line['delete_token'] = (string)$this->csrfTokenManager->getToken('delete' . $line['id']);
            $line['edit_token'] = (string)$this->csrfTokenManager->getToken('edit' . $line['id']);

            if (!empty($line['startDate'])) $line['startDate'] = $line['startDate']->format("d/m/Y");
            if (!empty($line['releaseDate'])) $line['releaseDate'] = $line['releaseDate']->format("d/m/Y");

            return $line;
        };

        return $formatter;
    }

    public function buildDatatable(array $options = [])
    {

        $this->ajax->set([]);

        $this->options->set($this->getDefaultsOptions([
            //'individual_filtering' => true
        ]));

        $this->features->set([]);

        $this->columnBuilder
            ->add('number', Column::class, [
                'title' => 'Number',
            ])
            ->add('route.title', Column::class, [
                'title' => 'Route',
            ])
            ->add('driver.title', Column::class, [
                'title' => 'Driver',
            ])
            ->add('transport.title', Column::class, [
                'title' => 'Transport',
            ])
            ->add('placeFrom', Column::class, [
                'title' => 'From place',
            ])
            ->add('placeTo', Column::class, [
                'title' => 'To place',
            ])
            ->add('startDate', Column::class, [
                'title' => 'Start Date',
            ])
            ->add('releaseDate', Column::class, [
                'title' => 'Release Date',
            ])

            ->add(null, ActionColumn::class, [
                'width' => "50px",
                "class_name" => "text-center",
                'actions' => [
                    [
                        'route' => $this->getRoutePrefix() . '.show',
                        'route_parameters' => [
                            'id' => 'id',
                        ],
                        'label' => $this->translator->trans('act.show'),
                        'icon' => 'mdi mdi-lead-pencil',
                        'attributes' => $this->getDefaultsActionAttributes($this->translator->trans('act.show'), 'js-emodal'),
                    ]
                ]
            ])

            ->add(null, ActionColumn::class, [
                'width' => "50px",
                "class_name" => "text-center",
                'actions' => [
                    [
                        'route' => $this->getRoutePrefix() . '.print',
                        'route_parameters' => [
                            'id' => 'id',
                            'token' => 'print_token'
                        ],
                        'label' => $this->translator->trans('act.print'),
                        'icon' => 'mdi mdi-lead-pencil',
                        'attributes' => $this->getDefaultsActionAttributes($this->translator->trans('act.print'), null, ['target' => '__blank']),
                        'render_if' => function () {
                            return $this->authorizationChecker->isGranted('ROLE_ADMIN');
                        },
                    ]
                ]
            ])

            ->add(null, ActionColumn::class, [
                'width' => "50px",
                "class_name" => "text-center",
                'actions' => [
                    [
                        'route' => $this->getRoutePrefix() . '.edit',
                        'route_parameters' => [
                            'id' => 'id',
                            'token' => 'edit_token'
                        ],
                        'label' => $this->translator->trans('act.edit'),
                        'icon' => 'mdi mdi-lead-pencil',
                        'attributes' => $this->getDefaultsActionAttributes($this->translator->trans('act.edit')),
                        'render_if' => function () {
                            return $this->authorizationChecker->isGranted('ROLE_ADMIN');
                        },
                    ]
                ]
            ])

            ->add(null, ActionColumn::class, [
                'width' => "50px",
                "class_name" => "text-center",
                'actions' => [
                    [
                        'route' => $this->getRoutePrefix() . '.delete',
                        'route_parameters' => [
                            'id' => 'id',
                            'token' => 'delete_token'
                        ],
                        'label' => $this->translator->trans('act.delete'),
                        'icon' => 'mdi mdi-delete',
                        'confirm'   => true,
                        'confirm_message' => $this->translator->trans('act.delete_msg'),
                        'attributes' => $this->getDefaultsActionAttributes($this->translator->trans('act.delete')),
                        'render_if' => function () {
                            return $this->authorizationChecker->isGranted('ROLE_ADMIN');
                        },
                    ]
                ]
            ])
        ;
    }

    public function getEntity()
    {
        return Trip::class;
    }

    public function getRoutePrefix()
    {
        return 'trips';
    }

    public function addFields()
    {

    }
}
