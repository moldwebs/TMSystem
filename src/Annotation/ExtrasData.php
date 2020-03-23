<?php


namespace App\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation()
 * @Target("PROPERTY")
 */
class ExtrasData
{

    public $fields = array();

    public $setter;

}