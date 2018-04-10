<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
	public function __construct(RegistryInterface $registry)
	{
		parent::__construct($registry, Animal::class);
	}

	public function qtsPorRaca() {
		$q = $this->createQueryBuilder("a")
			->select(["count(a) as qtde", "r.nome"])
			->innerJoin("a.raca", "r") //animal.raca_id = raca.id
			->groupBy("r.nome")
			->getQuery();

		return $q->getResult();
	}
}
