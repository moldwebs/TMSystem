<?php


namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ExtrasTrait
{

    /**
     * @ORM\Column(type="object")
     */
    private $extras;

    /**
     * @return mixed
     */
    public function getExtras($field = null)
    {
        if ($field) return $this->extras[$field] ?? null;
        return $this->extras ?? [];
    }

    /**
     * @param mixed $extras
     */
    public function setExtras($extras): void
    {
        $this->extras = $extras;
    }

}
