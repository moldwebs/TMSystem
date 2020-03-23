<?php


namespace App\Controller\Backend\Options;

use App\Entity\Options\Transport;
use App\Form\Options\TransportType;
use App\Datatables\Options\TransportDatatable;

use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;

use App\Services\DatatableService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AppController;
use App\Exception\InvalidCsrfTokenException;


/**
 * @Route("/transport", name="transport")
 * @IsGranted("ROLE_MANAGER")
 */
class TransportController extends AppController
{

    use EntityManagerTrait, RequestTrait;

    /**
     * @Route("/index", name=".index")
     */
    public function index(DatatableService $datatableService)
    {

        $datatable = $datatableService->getDatatable(TransportDatatable::class);

        if ($this->request->isXmlHttpRequest()) {
            return $datatableService->getResponse($datatable);
        }

        return $this->render('backend/options_transport/index.html.twig', [
            'datatable' => $datatable,
        ]);
    }

    /**
     * @Route("/show/{id}", name=".show")
     */
    public function show(Transport $entity)
    {
        return $this->render("backend/options_driver/show.html.twig", [
            'item' => $entity,
            'data' => $this->createForm(TransportType::class, $entity)->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name=".edit", defaults={"id": null})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(?Transport $entity)
    {
        if($entity && !$this->isCsrfTokenValid('edit' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        if (null === $entity)
            $entity = new Transport();

        $form = $this->createForm(TransportType::class, $entity);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($entity);
            $this->em->flush();

            $this->addFlash("success", "Item successfully saved");
            return $this->redirectToRoute('transport.index');
        }

        return $this->render("backend/options_transport/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name=".delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Transport $entity)
    {
        if(!$this->isCsrfTokenValid('delete' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        $this->em->remove($entity);
        $this->em->flush();

        $this->addFlash("success", "Item successfully removed");
        return $this->redirectToRoute('transport.index');
    }

}