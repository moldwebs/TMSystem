<?php


namespace App\Controller\Backend;

use App\Controller\AppController;
use App\Entity\Page;
use App\Datatables\PageDatatable;
use App\Form\PageType;

use App\Services\DatatableService;

use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Exception\InvalidCsrfTokenException;

/**
 * @Route("/pages", name="pages")
 */
class PagesController extends AppController
{

    use EntityManagerTrait, RequestTrait;

    /**
     * @Route("/", name=".index")
     */
    public function index(DatatableService $datatableService)
    {

        $datatable = $datatableService->getDatatable(PageDatatable::class);

        if ($this->request->isXmlHttpRequest()) {
            return $datatableService->getResponse($datatable);
        }

        return $this->render('backend/cms/pages/index.html.twig', [
            'datatable' => $datatable,
        ]);
    }


    /**
     * @Route("/preview/{id}", name=".preview")
     */
    public function preview(Page $entity)
    {
        return $this->render("backend/cms/pages/preview.html.twig", [
            'item' => $entity,
            'data' => $this->createForm(PageType::class, $entity)->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name=".edit", defaults={"id": null})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(?Page $entity)
    {
        if($entity && !$this->isCsrfTokenValid('edit' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        if (null === $entity)
            $entity = new Page();

        $form = $this->createForm(PageType::class, $entity);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($entity);
            $this->em->flush();

            $this->addFlash("success", "Item successfully saved");
            return $this->redirectToRoute('pages.index');
        }

        return $this->render("backend/cms/pages/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name=".delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Page $entity)
    {
        if(!$this->isCsrfTokenValid('delete' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        $this->em->remove($entity);
        $this->em->flush();

        $this->addFlash("success", "Item successfully removed");
        return $this->redirectToRoute('pages.index');
    }
}