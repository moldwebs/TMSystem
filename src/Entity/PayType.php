<?php


namespace App\Entity;

use App\Traits\Entity\BaseFieldsTrait;
use App\Traits\Entity\TitleTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cms_paytype")
 */
class PayType
{

    use BaseFieldsTrait, TitleTrait;

}