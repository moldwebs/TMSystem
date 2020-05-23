<?php


namespace App\Datatables;


use App\Entity\Trip;

use App\Datatables\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\Column;

class TripsDatatable extends AbstractDatatable
{
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