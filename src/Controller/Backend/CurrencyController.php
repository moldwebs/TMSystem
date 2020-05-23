<?php


namespace App\Controller\Backend;


use App\Entity\Currency;
use App\Form\CurrencyType;
use App\Datatables\CurrencyDatatable;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/currency", name="currency")
 * @IsGranted("ROLE_MANAGER")
 */
class CurrencyController extends AbstractController
{
    public function getDatatable()
    {
        return CurrencyDatatable::class;
    }

    public function getEntity()
    {
        return Currency::class;
    }

    public function getEntityType()
    {
        return CurrencyType::class;
    }

    public function getRoutePrefix()
    {
        return 'currency';
    }

    public function getTitle()
    {
        return 'Currency';
    }

}
