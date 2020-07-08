<?php


namespace App\Entity;

use App\Entity\Options\Driver;
use App\Entity\Options\Transport;
use App\Traits\Entity\BaseFieldsTrait;
use App\Traits\Entity\TitleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cms_trips")
 * @ORM\HasLifecycleCallbacks()
 */
class Trip
{

    use BaseFieldsTrait;

    public function __construct()
    {
        $this->costsData = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Options\Route")
     */
    private $route;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Options\Driver")
     * @var Driver
     */
    private $driver;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Options\Transport")
     * @var Transport
     */
    private $transport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Options\Transport")
     * @ORM\JoinColumn(nullable=true)
     */
    private $withTransport;

    /**
     * @ORM\Column(type="string")
     */
    private $placeFrom;

    /**
     * @ORM\Column(type="string")
     */
    private $placeTo;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $releaseDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Options\CostsData", orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="cms_trips_costs_data")
     */
    private $costsData;

    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route): void
    {
        $this->route = $route;
    }

    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param mixed $transport
     */
    public function setTransport($transport): void
    {
        $this->transport = $transport;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param mixed $driver
     */
    public function setDriver($driver): void
    {
        $this->driver = $driver;
    }

    /**
     * @return mixed
     */
    public function getCostsData()
    {
        return $this->costsData;
    }

    /**
     * @param mixed $costsData
     */
    public function setCostsData($costsData): void
    {
        $this->costsData = $costsData;
    }

    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    public function getWithTransport()
    {
        return $this->withTransport;
    }

    /**
     * @param mixed $withTransport
     */
    public function setWithTransport($withTransport): void
    {
        $this->withTransport = $withTransport;
    }

    public function getPlaceFrom()
    {
        return $this->placeFrom;
    }

    /**
     * @param mixed $placeFrom
     */
    public function setPlaceFrom($placeFrom): void
    {
        $this->placeFrom = $placeFrom;
    }

    public function getPlaceTo()
    {
        return $this->placeTo;
    }

    /**
     * @param mixed $placeTo
     */
    public function setPlaceTo($placeTo): void
    {
        $this->placeTo = $placeTo;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     */
    public function setReleaseDate($releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @ORM\PreFlush()
     */
    public function onSave()
    {
        //dd($this->getCostsData());
    }

}
