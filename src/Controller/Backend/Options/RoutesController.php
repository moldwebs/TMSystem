<?php


namespace App\Controller\Backend\Options;


use App\Entity\Options\Route as TripRoute;
use App\Form\Options\RouteType;
use App\Datatables\Options\RoutesDatatable;

use App\Controller\Backend\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/routes", name="routes")
 * @IsGranted("ROLE_MANAGER")
 */
class RoutesController extends AbstractController
{
    public function getDatatable()
    {
        return RoutesDatatable::class;
    }

    public function getEntity()
    {
        return TripRoute::class;
    }

    public function getEntityType()
    {
        return RouteType::class;
    }

    public function getRoutePrefix()
    {
        return 'routes';
    }

    public function getTitle()
    {
        return 'Routes';
    }

}