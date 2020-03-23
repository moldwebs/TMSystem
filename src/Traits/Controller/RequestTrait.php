<?php


namespace App\Traits\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

trait RequestTrait
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     * @required
     */
    public function setRequest(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }
}