<?php


namespace App\Datatables;


use App\Entity\Page;

use App\Datatables\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\Column;

class PagesDatatable extends AbstractDatatable
{
    public function getEntity()
    {
        return Page::class;
    }

    public function getRoutePrefix()
    {
        return 'admin.pages';
    }

    public function addFields()
    {

    }
}