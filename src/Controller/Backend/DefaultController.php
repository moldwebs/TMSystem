<?php


namespace App\Controller\Backend;

use App\Controller\AppController;
use App\Entity\Setting;
use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AppController
{

    use EntityManagerTrait, RequestTrait;

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

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {

        die();

        $pdfTrip = [
            'Numar', 'Sofer', 'Transport (numar)', 'Transport (marca)', 'Place (incarcare)', 'Place (descarcare)',
            'FP Transport (numar)'
        ];

        $i = 1;
        foreach ($pdfTrip as $item) {
            $setting = new Setting();
            $setting->setPosition($i++);
            $setting->setTitle($item);
            $setting->setType('ordin_pdf');
            $this->em->persist($setting);
        }

        $this->em->flush();
    }
}
