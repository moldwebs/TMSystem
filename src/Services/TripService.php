<?php


namespace App\Services;


use App\Entity\Trip;
use setasign\Fpdi\Fpdi;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class TripService
 * @package App\Services
 * https://www.pdf-online.com/osa/extract.aspx
 */
class TripService
{

    /**
     * @var ParameterBag
     */
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function generateDoc(Trip $trip)
    {

        $pdf = new Fpdi();

        //$pdf->SetAutoPageBreak(false);
        $pdf->SetFont('arial', '', 8);

        $pdf->setSourceFile(dirname(dirname(__DIR__)) . '/assets/docs/ordin.pdf');
        $pdf->AddPage();
        $tplId = $pdf->importPage(1);
        $pdf->useTemplate($tplId);

        $pdf->Text(24, 10, $this->parameterBag->get('app.company'));


        $pdf->AddPage();
        $tplId = $pdf->importPage(2);
        $pdf->useTemplate($tplId);

        $pdf->Output();
    }

}
