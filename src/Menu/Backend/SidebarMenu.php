<?php


namespace App\Menu\Backend;


use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class SidebarMenu
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function build(): ItemInterface
    {

        $sysTypes = [
            'route' => 'Rute',
            'driver' => 'Soferi',
            'transport' => 'Transport',
        ];

        $menu = $this->factory->createItem('root')
            ->setChildrenAttributes(['class' => 'nav']);

        $menu->addChild('Menu')
            ->setAttribute('class', 'nav-item nav-category');

        $menu->addChild('Dashboard', ['route' => 'dashboard'])
            ->setExtra('icon', 'box')
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        $menu_items = $menu->addChild('Items')
            ->setExtra('icon', 'list')
            ->setExtra('idx', uniqid())
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        foreach ($sysTypes as $key => $label) {
            $menu_items->addChild($label, ['route' => "{$key}.index"])
                ->setExtra('routes', [
                    ['pattern' => "/^{$key}\..+/"]
                ])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        }

        $menu_terms = $menu->addChild('Terms')
            ->setExtra('icon', 'calendar')
            ->setExtra('idx', uniqid())
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        foreach ($sysTypes as $key => $label) {
            $menu_terms->addChild($label, [
                'route' => 'term.index',
                'routeParameters' => [
                    'type' => $key
                ]
            ])
                ->setExtra('routes', [
                    [
                        'pattern' => '/^term\..+/',
                        'parameters' => [
                            'type' => $key
                        ]
                    ]
                ])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        }

        $menu_costs = $menu->addChild('Costs')
            ->setExtra('icon', 'dollar-sign')
            ->setExtra('idx', uniqid())
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        $costsTypes = [
            'route' => 'Rute',
        ];

        foreach ($costsTypes as $key => $label) {
            $menu_costs->addChild($label, [
                'route' => 'costs.index',
                'routeParameters' => [
                    'type' => $key
                ]
            ])
                ->setExtra('routes', [
                    [
                        'pattern' => '/^costs\..+/',
                        'parameters' => [
                            'type' => $key
                        ]
                    ]
                ])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        }

        $menu->addChild('Cms')
            ->setAttribute('class', 'nav-item nav-category');

        $menu->addChild('Pages', ['route' => 'pages.index'])
            ->setExtra('icon', 'book')
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        $menu->addChild('Info')
            ->setAttribute('class', 'nav-item nav-category');

        $menu->addChild('Documentatie', ['route' => 'documentation'])
            ->setExtra('icon', 'hash')
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        $menu->addChild('Template', ['uri' => 'https://www.nobleui.com/laravel/template/light/'])
            ->setExtra('icon', 'external-link')
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        return $menu;
    }
}