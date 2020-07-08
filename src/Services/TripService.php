<?php


namespace App\Services;


use App\Entity\Setting;
use App\Entity\Trip;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ParameterBagInterface $parameterBag, EntityManagerInterface $manager)
    {
        $this->parameterBag = $parameterBag;
        $this->manager = $manager;
    }

    public function generateDoc(Trip $trip)
    {

        $pdf = new Fpdi();

        //$pdf->SetAutoPageBreak(false);
        $pdf->SetFont('helvetica', 'B', 9);

        $pdf->setSourceFile(dirname(dirname(__DIR__)) . '/assets/docs/ordin.pdf');
        $pdf->AddPage();
        $tplId = $pdf->importPage(1);
        $pdf->useTemplate($tplId);

        $values = [
            'numar' => $trip->getNumber(),
            'sofer' => $trip->getDriver()->getTitle(),
            'transport-numar' => $trip->getTransport()->getTitle(),
            'transport-marca' => $trip->getTransport()->getExtras('model'),
            'place-incarcare' => strtoupper($trip->getPlaceFrom()),
            'place-descarcare' => strtoupper($trip->getPlaceTo()),
            'fp-transport-numar' => $trip->getTransport()->getTitle(),
        ];

        $coords = $this->manager->getRepository(Setting::class)->findBy([
            'type' => 'ordin_pdf'
        ]);
        foreach ($coords as $coord) {
            if (empty($coord->getValue())) continue;
            $pdf->Text(explode('x', $coord->getValue())[0], explode('x', $coord->getValue())[1], $values[$coord->getSlug()]);
        }

        $pdf->AddPage();
        $tplId = $pdf->importPage(2);
        $pdf->useTemplate($tplId);

        $pdf->Output();
    }

}
