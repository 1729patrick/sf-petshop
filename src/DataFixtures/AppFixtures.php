<?php

namespace App\Datafixtures;

use App\Entity\Especie;
use App\Entity\Raca;
use Doctrine\Bundle\FixturesBundle\Tests\Fixtures;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixtures {
	public function load(ObjectManager $manager)
	{
		$especies = [
			"Cachorro" => [
				['nome' => "SRD"],
				['nome' => "Boxer"],
				['nome' => "Shihtzu"],
				['nome' => "Poodle"]
			],
			"Gato" => [
				['nome' => "SRD"],
				['nome' => "Siamês"],
				['nome' => "Angorá"]
			]
		];

		foreach ($especies as $especie => $racas) {
			$obj = new Especie();
			$obj->setNome($especie);
			$manager->persist($obj);

			foreach ($racas as $raca) {
				$obj2 = new Raca();
				$obj2->setNome($raca['nome']);
				$obj2->setEspecie($obj);
				$manager->persist($obj2);
			}
		}
		$manager->flush();
	}

}