<?php


namespace App\Datatables\Options;


use App\Entity\Options\Route;

use App\Datatables\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\Column;

class RoutesDatatable extends AbstractDatatable
{
    public function getEntity()
    {
        return Route::class;
    }

    public function getRoutePrefix()
    {
        return 'routes';
    }

    public function addFields()
    {

    }
}