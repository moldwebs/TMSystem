<?php


namespace App\DataFixtures;


use App\Entity\Options\Term;
use App\Entity\Setting;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    /**
     * @var ObjectManager
     */
    private $manager;

    public function setManager(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->loadUsers();
        $this->loadTerms();
        $this->loadSettings();
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

    private function loadSettings()
    {
        $pdfTrip = [
            'Numar', 'Sofer', 'Transport (numar)', 'Transport (marca)', 'Place (incarcare)', 'Place (descarcare)',
            'FP Transport (numar)'
        ];

        $i = 1;
        foreach ($pdfTrip as $item) {
            $setting = new Setting();
            $setting->setPosition($i++);
            $setting->setTitle($item);
            $this->manager->persist($setting);
        }

        $this->manager->flush();
    }
}
