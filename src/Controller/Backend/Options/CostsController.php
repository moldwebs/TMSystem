<?php


namespace App\Controller\Backend\Options;

use App\Datatables\Options\CostsDatatable;
use App\Entity\Options\Costs;
use App\Form\Options\CostsType;

use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;

use App\Services\DatatableService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AppController;
use App\Exception\InvalidCsrfTokenException;


/**
 * @Route("/costs", name="costs")
 * @IsGranted("ROLE_ADMIN")
 */
class CostsController extends AppController
{

    use EntityManagerTrait, RequestTrait;

    /**
     * @Route("/{type}/index", name=".index")
     */
    public function index(DatatableService $datatableService)
    {

        $datatable = $datatableService->getDatatable(CostsDatatable::class);

        if ($this->request->isXmlHttpRequest()) {
            $datatableResponseService = $datatableService->getResponseService($datatable);
            $datatableQueryBuilder  = $datatableResponseService->getDatatableQueryBuilder();
            $qb = $datatableQueryBuilder->getQb();
            $qb
                ->andWhere('costs.type = :type')
                ->setParameter('type', $this->request->get('type'))
            ;
            return $datatableResponseService->getResponse();
        }

        return $this->render('backend/options_costs/index.html.twig', [
            'datatable' => $datatable,
        ]);
    }

    /**
     * @Route("/{type}/edit/{id}", name=".edit", defaults={"id": null})
     */
    public function edit(?Costs $entity)
    {
        if($entity && !$this->isCsrfTokenValid('edit' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        if (null === $entity)
            $entity = new Costs();

        $form = $this->createForm(CostsType::class, $entity);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entity->setType($this->request->get('type'));

            $this->em->persist($entity);
            $this->em->flush();

            $this->addFlash("success", "Item successfully saved");
            return $this->redirectToRoute('costs.index', ['type' => $this->request->get('type')]);
        }

        return $this->render("backend/options_costs/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{type}/delete/{id}", name=".delete")
     */
    public function delete(?Costs $entity)
    {
        if(!$this->isCsrfTokenValid('delete' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        $this->em->remove($entity);
        $this->em->flush();

        $this->addFlash("success", "Item successfully removed");
        return $this->redirectToRoute('costs.index', ['type' => $this->request->get('type')]);
    }

}