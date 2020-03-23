<?php


namespace App\DataFixtures;


use App\Entity\Options\Term;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->loadUsers();
        $this->loadTerms();
    }

    private function loadUsers()
    {
        $user = new User();
        $user->setEmail('admin@mail.com');
        $user->setUsername('admin@mail.com');
        $user->setPlainPassword('admin55555');
        $user->setSuperAdmin(true);
        $user->setEnabled(true);

        $this->manager->persist($user);
        $this->manager->flush();
    }

    private function loadTerms()
    {
        $terms = [
            'driver' => [
                'Termen medic',
                'Termen procura',
                'Termen permis',
                'Termen narcolog',
                'Termen competenta',
            ],
            'transport' => [
                'Termen asigurare',
                'Termen testare tehnica',
            ]
        ];

        foreach ($terms as $type => $_terms) {
            foreach ($_terms as $_term) {
                $term = new Term();
                $term->setType($type);
                $term->setTitle($_term);
                $this->manager->persist($term);
            }
        }

        $this->manager->flush();
    }
}