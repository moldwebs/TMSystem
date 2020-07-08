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
            'routes' => 'Rute',
            'drivers' => 'Soferi',
            'transport' => 'Transport',
        ];

        $menu = $this->factory->createItem('root')
            ->setChildrenAttributes(['class' => 'nav']);

//        $menu->addChild('Menu')
//            ->setAttribute('class', 'nav-item nav-category');

        $menu->addChild('Dashboard', ['route' => 'dashboard'])
            ->setExtra('icon', 'box')
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        $menu->addChild('Trips', ['route' => 'trips.index'])
            ->setExtra('routes', [
                ['pattern' => "/^trips\..+/"]
            ])
            ->setExtra('icon', 'navigation-2')
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

//        $menu->addChild('Optiuni')
//            ->setAttribute('class', 'nav-item nav-category');

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
                'route' => 'terms.index',
                'routeParameters' => [
                    'type' => $key
                ]
            ])
            ->setExtra('routes', [
                [
                    'pattern' => '/^terms\..+/',
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
            'routes' => 'Rute',
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

        $menu_costs->addChild('Currency', ['route' => 'currency.index'])
            ->setExtra('routes', [
                ['pattern' => "/^currency\..+/"]
            ])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        $menu_costs->addChild('Pay Types', ['route' => 'pay-types.index'])
            ->setExtra('routes', [
                ['pattern' => "/^pay-types\..+/"]
            ])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        $menu_settings = $menu->addChild('Settings')
            ->setExtra('icon', 'sliders')
            ->setExtra('idx', uniqid())
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        $menu_settings->addChild('Ordin', [
            'route' => 'settings.index',
            'routeParameters' => [
                'type' => 'ordin_pdf'
            ]
        ])
        ->setExtra('routes', [
            [
                'pattern' => '/^settings\..+/',
                'parameters' => [
                    'type' => 'ordin_pdf'
                ]
            ]
        ])
        ->setAttribute('class', 'nav-item')
        ->setLinkAttribute('class', 'nav-link');

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

        $menu->addChild('Run Queue', ['route' => 'makesome'])
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
