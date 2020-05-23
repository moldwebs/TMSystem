<?php


namespace App\Datatables;


use App\Entity\PayType;

use App\Datatables\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\Column;

class PayTypesDatatable extends AbstractDatatable
{
    public function getEntity()
    {
        return PayType::class;
    }

    public function getRoutePrefix()
    {
        return 'pay-types';
    }

    public function addFields()
    {
    }
}