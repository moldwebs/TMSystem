<?php


namespace App\Entity;

use App\Traits\Entity\BaseFieldsTrait;
use App\Traits\Entity\TitleTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cms_trip")
 */
class Trip
{

    use BaseFieldsTrait, TitleTrait;

}