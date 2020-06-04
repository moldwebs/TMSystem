<?php


namespace App\Entity\Options;

use App\Traits\Entity\TitleTrait;
use App\Traits\Entity\BaseFieldsTrait;
use App\Traits\Entity\ExtrasTrait;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="options_routes")
 */
class Route
{
    use BaseFieldsTrait, TitleTrait, ExtrasTrait;

    public function __construct()
    {
        $this->termData = new ArrayCollection();
        $this->costsData = new ArrayCollection();
    }

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Options\TermData", orphanRemoval=true, cascade={"all"})
     * @ORM\JoinTable(name="options_routes_term_data")
     */
    private $termData;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Options\CostsData", orphanRemoval=true, cascade={"all"})
     * @ORM\JoinTable(name="options_routes_costs_data")
     */
    private $costsData;

    public function getTermData()
    {
        return $this->termData;
    }

    /**
     * @param mixed $termData
     */
    public function setTermData($termData): void
    {
        $this->termData = $termData;
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



}
