<?php


namespace App\Traits\Datatables;


use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

trait DefaultsTrait
{

    /**
     * @var CsrfTokenManager
     */
    protected $csrfTokenManager;

    public function setCsrfTokenManager(CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->csrfTokenManager = $csrfTokenManager;
    }

    protected function getDefaultsOptions($options = [])
    {
        return array_merge([
            'classes' => 'table dataTable no-footer',
            'individual_filtering' => false,
            'individual_filtering_position' => 'head',
            'global_search_type' => 'like',
            'order_cells_top' => true,
            'order' => [[0, 'desc']],
        ], $options);
    }

    protected function getDefaultsActionAttributes($label, $class = null, $attributes = [])
    {
        return array_merge([
            'rel' => 'tooltip',
            'title' => $label,
            'class' => 'btn btn-secondary btn-xs ' . $class,
            'role' => 'button'
        ], $attributes);
    }

}
