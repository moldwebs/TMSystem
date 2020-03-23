<?php


namespace App\Controller\Backend\Options;

use App\Entity\Options\Route as TRoute;
use App\Datatables\Options\RouteDatatable;
use App\Form\Options\RouteType;

use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;

use App\Services\DatatableService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AppController;
use App\Exception\InvalidCsrfTokenException;


/**
 * @Route("/route", name="route")
 * @IsGranted("ROLE_MANAGER")
 */
class RouteController extends AppController
{

    use EntityManagerTrait, RequestTrait;

    /**
     * @Route("/index", name=".index")
     */
    public function index(DatatableService $datatableService)
    {

        $datatable = $datatableService->getDatatable(RouteDatatable::class);

        if ($this->request->isXmlHttpRequest()) {
            return $datatableService->getResponse($datatable);
        }

        return $this->render('backend/options_route/index.html.twig', [
            'datatable' => $datatable,
        ]);
    }

    /**
     * @Route("/show/{id}", name=".show")
     */
    public function show(TRoute $entity)
    {
        return $this->render("backend/options_route/show.html.twig", [
            'item' => $entity,
            'data' => $this->createForm(RouteType::class, $entity)->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name=".edit", defaults={"id": null})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(?TRoute $entity)
    {
        if($entity && !$this->isCsrfTokenValid('edit' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        if (null === $entity)
            $entity = new TRoute();

        $form = $this->createForm(RouteType::class, $entity);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($entity);
            $this->em->flush();

            $this->addFlash("success", "Item successfully saved");
            return $this->redirectToRoute('route.index');
        }

        return $this->render("backend/options_route/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name=".delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(TRoute $entity)
    {
        if(!$this->isCsrfTokenValid('delete' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        $this->em->remove($entity);
        $this->em->flush();

        $this->addFlash("success", "Item successfully removed");
        return $this->redirectToRoute('route.index');
    }

}