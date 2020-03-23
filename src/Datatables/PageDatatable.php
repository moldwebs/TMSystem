<?php


namespace App\Datatables;


use App\Entity\Page;

use App\Traits\Datatables\DefaultsTrait;
use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\Column;

class PageDatatable extends AbstractDatatable
{

    use DefaultsTrait;

    public function getLineFormatter()
    {
        $formatter = function ($line) {
            $line['delete_token'] = (string)$this->csrfTokenManager->getToken('delete' . $line['id']);
            $line['edit_token'] = (string)$this->csrfTokenManager->getToken('edit' . $line['id']);
            return $line;
        };

        return $formatter;
    }

    public function buildDatatable(array $options = [])
    {

        $this->ajax->set([]);

        $this->options->set($this->getDefaultsOptions());

        $this->features->set([]);

        $this->columnBuilder


            ->add('title', Column::class, [
                'title' => 'Title',
            ])

            ->add(null, ActionColumn::class, [
                'width' => "50px",
                "class_name" => "text-center",
                'actions' => [
                    [
                        'route' => 'admin.pages.preview',
                        'route_parameters' => [
                            'id' => 'id',
                        ],
                        'label' => $this->translator->trans('act.preview'),
                        'icon' => 'mdi mdi-lead-pencil',
                        'attributes' => $this->getDefaultsActionAttributes($this->translator->trans('act.preview')),
                    ]
                ]
            ])

            ->add(null, ActionColumn::class, [
                'width' => "50px",
                "class_name" => "text-center",
                'actions' => [
                    [
                        'route' => 'admin.pages.edit',
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
                        'route' => 'admin.pages.delete',
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
        return Page::class;
    }

    public function getName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}