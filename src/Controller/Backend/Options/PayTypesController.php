<?php


namespace App\Controller\Backend\Options;


use App\Entity\PayType;
use App\Form\PayTypeType;
use App\Datatables\PayTypesDatatable;

use App\Controller\Backend\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pay-types", name="pay-types")
 * @IsGranted("ROLE_MANAGER")
 */
class PayTypesController extends AbstractController
{
    public function getDatatable()
    {
        return PayTypesDatatable::class;
    }

    public function getEntity()
    {
        return PayType::class;
    }

    public function getEntityType()
    {
        return PayTypeType::class;
    }

    public function getRoutePrefix()
    {
        return 'pay-types';
    }

    public function getTitle()
    {
        return 'Pay Types';
    }

}