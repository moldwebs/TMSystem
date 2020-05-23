<?php


namespace App\Datatables\Options;


use App\Entity\Options\Driver;

use App\Datatables\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\Column;

class DriversDatatable extends AbstractDatatable
{
    public function getEntity()
    {
        return Driver::class;
    }

    public function getRoutePrefix()
    {
        return 'drivers';
    }

    public function addFields()
    {

    }
}