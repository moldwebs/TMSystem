<?php


namespace App\Controller\Api;


use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Options\Term;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

/**
 * @Route("/data", name="api.data.")
 */
class DataController extends FOSRestController
{

    /**
     * @Route("/test", name="test", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the data",
     * )
     * @SWG\Parameter(
     *     name="order",
     *     in="query",
     *     type="string",
     *     description="The field used to order data"
     * )
     * @SWG\Tag(name="Data")
     * @Security(name="Bearer")
     */
    public function test()
    {
        return $this->handleView($this->view(['data' => 'WORKS']));
    }


}