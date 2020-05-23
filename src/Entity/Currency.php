<?php


namespace App\Entity;

use App\Traits\Entity\BaseFieldsTrait;
use App\Traits\Entity\TitleTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cms_currency")
 */
class Currency
{

    use BaseFieldsTrait, TitleTrait;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $code;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }



}