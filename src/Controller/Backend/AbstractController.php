<?php


namespace App\Controller\Backend;


use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;

use App\Services\DatatableService;
use App\Controller\AppController;
use App\Exception\InvalidCsrfTokenException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

abstract class AbstractController extends AppController
{

    use EntityManagerTrait, RequestTrait;

    abstract public function getDatatable();
    abstract public function getEntity();
    abstract public function getEntityType();
    abstract public function getRoutePrefix();
    abstract public function getTitle();

    /**
     * @Route("/index", name=".index")
     */
    public function index(DatatableService $datatableService)
    {

        $datatable = $datatableService->getDatatable($this->getDatatable());

        if ($this->request->isXmlHttpRequest()) {
            return $datatableService->getResponse($datatable);
        }

        return $this->render('backend/options_abstract/index.html.twig', [
            'datatable' => $datatable,
            'route_prefix' => $this->getRoutePrefix(),
            'box_title' => $this->getTitle()
        ]);
    }

    /**
     * @Route("/show/{id}", name=".show")
     */
    public function show()
    {

        $entity = $this->em->getRepository($this->getEntity())->findOneBy([
            'id' => $this->request->get('id')
        ]);

        return $this->render("backend/options_abstract/show.html.twig", [
            'item' => $entity,
            'data' => $this->createForm($this->getEntityType(), $entity)->createView(),
            'route_prefix' => $this->getRoutePrefix(),
            'box_title' => $this->getTitle()
        ]);
    }

    /**
     * @Route("/edit/{id}", name=".edit", defaults={"id": null})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit()
    {

        $entity = $this->em->getRepository($this->getEntity())->findOneBy([
            'id' => $this->request->get('id')
        ]);

        if($entity && !$this->isCsrfTokenValid('edit' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        if (null === $entity) {
            $entity = $this->getEntity();
            $entity = new $entity;
        }

        $form = $this->createForm($this->getEntityType(), $entity);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($entity);
            $this->em->flush();

            $this->addFlash("success", "Item successfully saved");
            return $this->redirectToRoute( $this->getRoutePrefix() . '.index');
        }

        return $this->render("backend/options_abstract/edit.html.twig", [
            'form' => $form->createView(),
            'route_prefix' => $this->getRoutePrefix(),
            'box_title' => $this->getTitle()
        ]);
    }

    /**
     * @Route("/delete/{id}", name=".delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete()
    {

        $entity = $this->em->getRepository($this->getEntity())->findOneBy([
            'id' => $this->request->get('id')
        ]);

        if(!$this->isCsrfTokenValid('delete' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        $this->em->remove($entity);
        $this->em->flush();

        $this->addFlash("success", "Item successfully removed");
        return $this->redirectToRoute($this->getRoutePrefix() . '.index');
    }

}