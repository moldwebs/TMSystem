<?php


namespace App\Entity\Options;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="options_costs_data")
 */
class CostsData
{

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Options\Costs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $costs;

    /**
     * @ORM\Column(type="float")
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Currency")
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PayType")
     */
    private $payType;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCosts()
    {
        return $this->costs;
    }

    /**
     * @param mixed $costs
     */
    public function setCosts($costs): void
    {
        $this->costs = $costs;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost): void
    {
        $this->cost = $cost;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency): void
    {
        $this->currency = $currency;
    }

    public function getPayType()
    {
        return $this->payType;
    }

    /**
     * @param mixed $payType
     */
    public function setPayType($payType): void
    {
        $this->payType = $payType;
    }

}