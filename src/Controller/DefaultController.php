<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Cliente;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\VarDumper\VarDumper;
use function var_dump;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="default")
	 * @Template("default/index.html.twig")
	 */
	public function index() {
		$em = $this->getDoctrine()->getManager();

		$qts_animais = $em->getRepository(Cliente::class)->qtsAnimaisPorCliente();

		$qte_racas = $em->getRepository(Animal::class)->qtsPorRaca();

		VarDumper::dump($qts_animais);
		VarDumper::dump($qte_racas);
		return [
			'qts_animais' => $qts_animais,
			'qtde_por_raca' => $qte_racas
		];
	}
}
