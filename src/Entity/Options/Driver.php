<?php


namespace App\Entity\Options;

use App\Traits\Entity\TitleTrait;
use App\Traits\Entity\BaseFieldsTrait;
use App\Traits\Entity\ExtrasTrait;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="options_drivers")
 */
class Driver
{
    use BaseFieldsTrait, TitleTrait, ExtrasTrait;

    public function __construct()
    {
        $this->termData = new ArrayCollection();
    }

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Options\TermData", orphanRemoval=true, cascade={"all"})
     * @ORM\JoinTable(name="options_drivers_term_data")
     */
    private $termData;

    /**
     * @return mixed
     */
    public function getTermData()
    {
        return $this->termData;
    }

    /**
     * @param mixed $termData
     */
    public function addTermData($termData): void
    {
        $this->termData[] = $termData;
    }


}