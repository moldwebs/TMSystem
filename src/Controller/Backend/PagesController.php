<?php


namespace App\Controller\Backend;


use App\Entity\Page;
use App\Form\PageType;
use App\Datatables\PagesDatatable;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pages", name="pages")
 * @IsGranted("ROLE_MANAGER")
 */
class PagesController extends AbstractController
{
    public function getDatatable()
    {
        return PagesDatatable::class;
    }

    public function getEntity()
    {
        return Page::class;
    }

    public function getEntityType()
    {
        return PageType::class;
    }

    public function getRoutePrefix()
    {
        return 'pages';
    }

    public function getTitle()
    {
        return 'Pages';
    }

}