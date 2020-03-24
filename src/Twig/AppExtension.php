<?php


namespace App\Twig;


use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{

    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('active_class', [$this, 'activeClass']),
            new TwigFunction('is_active_route', [$this, 'isActiveRoute']),
            new TwigFunction('show_class', [$this, 'showClass']),
        ];
    }

    public function getFilters()
    {
        return [
            new TwigFilter('action', [$this, 'showAction']),
            new TwigFilter('dateortext', [$this, 'dateortextAction']),
        ];
    }

    public function activeClass(array $paths): string
    {
        return '';
    }

    public function isActiveRoute(array $paths): string
    {
        return '';
    }

    public function showClass(array $paths): string
    {
        return '';
    }

    public function showAction(string $data): string
    {
        return ($this->requestStack->getCurrentRequest()->get('id') ? 'act.edit' : 'act.create') . ' ' .  $data;
    }

    public function dateortextAction($data): string
    {
        if ($data instanceof \DateTime) {
            return $data->format("d/m/Y");
        } else {
            return $data;
        }
    }

}