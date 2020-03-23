<?php


namespace App\Entity;

use App\Traits\Entity\TitleTrait;
use App\Traits\Entity\BaseFieldsTrait;
use App\Traits\Entity\ExtrasTrait;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cms_pages")
 * @Gedmo\Loggable
 */
class Page
{
    use BaseFieldsTrait, TitleTrait, ExtrasTrait;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }



}