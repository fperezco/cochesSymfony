<?php

namespace App\DataFixtures;

use App\Entity\Marca;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{

    private const MARCAS = [
        'Seat',
        'BMV',
        'Fiat',
        'Renault',
        'Dodge'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::MARCAS as $nbrMarca) {
            $marca = new Marca();
            $marca->setNombre($nbrMarca);
            //la marca para el siguiente flush, no esta persistiendo ahora mismo
            $manager->persist($marca);
        }
        $manager->flush();
    }
}


