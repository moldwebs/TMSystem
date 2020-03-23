<?php


namespace App\Services;


use Sg\DatatablesBundle\Datatable\DatatableFactory;
use Sg\DatatablesBundle\Response\DatatableResponse;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class DatatableService
{
    /**
     * @var DatatableFactory
     */
    private $datatableFactory;
    /**
     * @var DatatableResponse
     */
    private $datatableResponse;
    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;

    public function __construct(DatatableFactory $datatableFactory, DatatableResponse $datatableResponse, CsrfTokenManagerInterface $csrfTokenManager)
    {

        $this->datatableFactory = $datatableFactory;
        $this->datatableResponse = $datatableResponse;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function getDatatable($class)
    {
        $datatable = $this->datatableFactory->create($class);
        if ( method_exists($datatable,'setCsrfTokenManager') )
            $datatable->setCsrfTokenManager($this->csrfTokenManager);
        $datatable->buildDatatable();
        return $datatable;
    }

    public function getResponse($datatable)
    {
        return $this->getResponseService($datatable)->getResponse();
    }

    public function getResponseService($datatable)
    {
        $responseService = $this->datatableResponse->setDatatable($datatable);
        $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
        return $responseService;
    }

}