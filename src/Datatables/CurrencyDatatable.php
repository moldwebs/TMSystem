<?php


namespace App\Datatables;


use App\Entity\Currency;

use App\Datatables\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\Column;

class CurrencyDatatable extends AbstractDatatable
{
    public function getEntity()
    {
        return Currency::class;
    }

    public function getRoutePrefix()
    {
        return 'currency';
    }

    public function addFields()
    {
        $this->columnBuilder
            ->add('code', Column::class, [
                'title' => 'Code',
            ])
            ->add('value', Column::class, [
            'title' => 'Value',
        ]);
    }
}