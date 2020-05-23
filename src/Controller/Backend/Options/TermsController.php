<?php


namespace App\Controller\Backend\Options;

use App\Datatables\Options\TermsDatatable;
use App\Entity\Options\Term;
use App\Form\Options\TermType;

use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;

use App\Services\DatatableService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AppController;
use App\Exception\InvalidCsrfTokenException;


/**
 * @Route("/terms", name="terms")
 * @IsGranted("ROLE_ADMIN")
 */
class TermsController extends AppController
{

    use EntityManagerTrait, RequestTrait;

    /**
     * @Route("/{type}/index", name=".index")
     */
    public function index(DatatableService $datatableService)
    {

        $datatable = $datatableService->getDatatable(TermsDatatable::class);

        if ($this->request->isXmlHttpRequest()) {
            $datatableResponseService = $datatableService->getResponseService($datatable);
            $datatableQueryBuilder  = $datatableResponseService->getDatatableQueryBuilder();
            $qb = $datatableQueryBuilder->getQb();
            $qb
                ->andWhere('term.type = :type')
                ->setParameter('type', $this->request->get('type'))
            ;
            return $datatableResponseService->getResponse();
        }

        return $this->render('backend/options_terms/index.html.twig', [
            'datatable' => $datatable,
        ]);
    }

    /**
     * @Route("/{type}/edit/{id}", name=".edit", defaults={"id": null})
     */
    public function edit(?Term $entity)
    {
        if($entity && !$this->isCsrfTokenValid('edit' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        if (null === $entity)
            $entity = new Term();

        $form = $this->createForm(TermType::class, $entity);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entity->setType($this->request->get('type'));

            $this->em->persist($entity);
            $this->em->flush();

            $this->addFlash("success", "Item successfully saved");
            return $this->redirectToRoute('terms.index', ['type' => $this->request->get('type')]);
        }

        return $this->render("backend/options_terms/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{type}/delete/{id}", name=".delete")
     */
    public function delete(?Term $entity)
    {
        if(!$this->isCsrfTokenValid('delete' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        $this->em->remove($entity);
        $this->em->flush();

        $this->addFlash("success", "Item successfully removed");
        return $this->redirectToRoute('terms.index', ['type' => $this->request->get('type')]);
    }

}