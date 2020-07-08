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
class PdfService
{

    /**
     * @var ParameterBag
     */
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function generateTrip(Trip $trip)
    {

        if (!empty($_GET['debug'])) $this->getCoords(dirname(dirname(__DIR__)) . '/assets/docs/ordin.pdf');

        $pdf = new Fpdi();

        //$pdf->SetAutoPageBreak(false);
        $pdf->SetFont('arial', '', 8);

        $pdf->setSourceFile(dirname(dirname(__DIR__)) . '/assets/docs/ordin.pdf');
        $pdf->AddPage();
        $tplId = $pdf->importPage(1);
        $pdf->useTemplate($tplId);

        $pdf->Text(24, 10, $this->parameterBag->get('app.company'));

        $testData = $this->getCoords(dirname(dirname(__DIR__)) . '/assets/docs/ordin.pdf', false);
        foreach ($testData[1] as $line) {
            $pdf->Text($line[0], $line[1], $line[2]);
        }


        $pdf->AddPage();
        $tplId = $pdf->importPage(2);
        $pdf->useTemplate($tplId);

        $pdf->Output();
    }

    private function getCoords($location, $debug = true)
    {
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($location);

        $coords = [];
        $pages = $pdf->getPages();

        $npage = 1;
        foreach ($pages as $page)
        {
            foreach ($page->getDataTm() as $data) {
                if (trim($data[1]) == '') continue;
                $coords[$npage][] = [
                    round($data[0][4], 0),
                    round($data[0][5], 0),
                    $data[1]
                ];
            }
            $npage++;
        }

        if ($debug) {
            print_r($coords);
            die();
        } else {
            return $coords;
        }

    }

}
