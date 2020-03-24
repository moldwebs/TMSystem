<?php


namespace App\Controller\Api;


use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/data", name="api.data.")
 */
class DataController extends FOSRestController
{

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return $this->handleView($this->view(['data' => 'WORKS']));
    }


}