<?php


namespace App\Controller\Backend\Options;


use App\Entity\Options\Driver;
use App\Form\Options\DriverType;
use App\Datatables\Options\DriversDatatable;

use App\Controller\Backend\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/drivers", name="drivers")
 * @IsGranted("ROLE_MANAGER")
 */
class DriversController extends AbstractController
{
    public function getDatatable()
    {
        return DriversDatatable::class;
    }

    public function getEntity()
    {
        return Driver::class;
    }

    public function getEntityType()
    {
        return DriverType::class;
    }

    public function getRoutePrefix()
    {
        return 'drivers';
    }

    public function getTitle()
    {
        return 'Drivers';
    }

}