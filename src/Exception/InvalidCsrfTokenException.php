<?php


namespace App\Exception;


use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class InvalidCsrfTokenException extends AccessDeniedException
{

}