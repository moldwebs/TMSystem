<?php


namespace App\Controller\Backend\Options;


use App\Entity\Options\Transport;
use App\Form\Options\TransportType;
use App\Datatables\Options\TransportDatatable;

use App\Controller\Backend\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transport", name="transport")
 * @IsGranted("ROLE_MANAGER")
 */
class TransportController extends AbstractController
{
    public function getDatatable()
    {
        return TransportDatatable::class;
    }

    public function getEntity()
    {
        return Transport::class;
    }

    public function getEntityType()
    {
        return TransportType::class;
    }

    public function getRoutePrefix()
    {
        return 'transport';
    }

    public function getTitle()
    {
        return 'Transport';
    }

}