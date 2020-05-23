<?php


namespace App\Datatables\Options;


use App\Entity\Options\Transport;

use App\Datatables\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Column\Column;

class TransportDatatable extends AbstractDatatable
{

    public function getLineFormatter()
    {
        $formatter = function ($line) {
            $line['delete_token'] = (string)$this->csrfTokenManager->getToken('delete' . $line['id']);
            $line['edit_token'] = (string)$this->csrfTokenManager->getToken('edit' . $line['id']);
            $line['type'] = Transport::TYPES[$line['type']];
            return $line;
        };

        return $formatter;
    }

    public function getEntity()
    {
        return Transport::class;
    }

    public function getRoutePrefix()
    {
        return 'transport';
    }

    public function addFields()
    {
        $this->columnBuilder
            ->add('type', Column::class, [
                'title' => 'Type',
                'width' => "150px",
            ])
        ;
    }
}