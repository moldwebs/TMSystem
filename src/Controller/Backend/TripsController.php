<?php


namespace App\Controller\Backend;

use App\Entity\Trip;
use App\Form\TripType;
use App\Datatables\TripsDatatable;

use App\Services\TripService;
use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;

use App\Services\DatatableService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AppController;
use App\Exception\InvalidCsrfTokenException;


/**
 * @Route("/trips", name="trips")
 * @IsGranted("ROLE_MANAGER")
 */
class TripsController extends AppController
{

    use EntityManagerTrait, RequestTrait;

    /**
     * @Route("/index", name=".index")
     */
    public function index(DatatableService $datatableService)
    {

        $datatable = $datatableService->getDatatable(TripsDatatable::class);

        if ($this->request->isXmlHttpRequest()) {
            return $datatableService->getResponse($datatable);
        }

        return $this->render('backend/trips/index.html.twig', [
            'datatable' => $datatable,
        ]);
    }

    /**
     * @Route("/show/{id}", name=".show")
     */
    public function show(Trip $entity)
    {
        return $this->render("backend/trips/show.html.twig", [
            'item' => $entity,
            'data' => $this->createForm(TripType::class, $entity)->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name=".edit", defaults={"id": null})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(?Trip $entity)
    {
        if($entity && !$this->isCsrfTokenValid('edit' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        if (null === $entity)
            $entity = new Trip();

        $form = $this->createForm(TripType::class, $entity);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($entity);
            $this->em->flush();

            $this->addFlash("success", "Item successfully saved");
            return $this->redirect($_SERVER['HTTP_REFERER']);
            return $this->redirectToRoute('trips.index');
        }

        return $this->render("backend/trips/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name=".delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Trip $entity)
    {
        if(!$this->isCsrfTokenValid('delete' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        $this->em->remove($entity);
        $this->em->flush();

        $this->addFlash("success", "Item successfully removed");
        return $this->redirectToRoute('trips.index');
    }

    /**
     * @Route("/print/{id}", name=".print")
     * @IsGranted("ROLE_ADMIN")
     */
    public function print(Trip $trip, TripService $tripService)
    {
        dd($tripService->generateDoc($trip));
    }

}
