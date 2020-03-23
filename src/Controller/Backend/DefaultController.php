<?php


namespace App\Controller\Backend;

use App\Controller\AppController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AppController
{

    /**
     * @Route("/", name="backend")
     */
    public function index()
    {
        return $this->redirectToRoute('dashboard');
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        return $this->render('backend/default/dashboard.html.twig');
    }

    /**
     * @Route("/documentation", name="documentation")
     */
    public function documentation()
    {
        return $this->render('backend/default/documentation.html.twig');
    }
}