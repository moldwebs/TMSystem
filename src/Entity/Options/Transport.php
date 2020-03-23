<?php


namespace App\Entity\Options;

use App\Traits\Entity\TitleTrait;
use App\Traits\Entity\BaseFieldsTrait;
use App\Traits\Entity\ExtrasTrait;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="options_transport")
 */
class Transport
{
    use BaseFieldsTrait, TitleTrait, ExtrasTrait;

    const TYPES = [
        1 => 'Rutiera',
        2 => 'Autocar'
    ];

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Options\TermData", orphanRemoval=true, cascade={"all"})
     * @ORM\JoinTable(name="options_transport_term_data")
     */
    private $termData;

    public function __construct()
    {
        $this->termData = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

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