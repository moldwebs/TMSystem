<?php


namespace App\Controller\Backend;


use App\Datatables\SettingsDatatable;
use App\Entity\Setting;
use App\Form\SettingType;
use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;

use App\Services\DatatableService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AppController;
use App\Exception\InvalidCsrfTokenException;


/**
 * @Route("/settings", name="settings")
 * @IsGranted("ROLE_ADMIN")
 */
class SettingsController extends AppController
{

    use EntityManagerTrait, RequestTrait;

    /**
     * @Route("/{type}/index", name=".index")
     */
    public function index(DatatableService $datatableService)
    {

        $datatable = $datatableService->getDatatable(SettingsDatatable::class);

        if ($this->request->isXmlHttpRequest()) {
            $datatableResponseService = $datatableService->getResponseService($datatable);
            $datatableQueryBuilder  = $datatableResponseService->getDatatableQueryBuilder();
            $qb = $datatableQueryBuilder->getQb();
            $qb
                ->andWhere('setting.type = :type')
                ->setParameter('type', $this->request->get('type'))
            ;
            return $datatableResponseService->getResponse();
        }

        return $this->render('backend/settings/index.html.twig', [
            'datatable' => $datatable,
        ]);
    }

    /**
     * @Route("/{type}/edit/{id}", name=".edit", defaults={"id": null})
     */
    public function edit(?Setting $entity)
    {
        if($entity && !$this->isCsrfTokenValid('edit' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        if (null === $entity)
            $entity = new Setting();

        $form = $this->createForm(SettingType::class, $entity);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entity->setType($this->request->get('type'));

            $this->em->persist($entity);
            $this->em->flush();

            $this->addFlash("success", "Item successfully saved");
            return $this->redirectToRoute('settings.index', ['type' => $this->request->get('type')]);
        }

        return $this->render("backend/settings/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{type}/delete/{id}", name=".delete")
     */
    public function delete(?Setting $entity)
    {
        if(!$this->isCsrfTokenValid('delete' . $entity->getId(), $this->request->get('token')))
            throw new InvalidCsrfTokenException();

        $this->em->remove($entity);
        $this->em->flush();

        $this->addFlash("success", "Item successfully removed");
        return $this->redirectToRoute('settings.index', ['type' => $this->request->get('type')]);
    }

}
