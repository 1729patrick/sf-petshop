<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AnimaisController extends Controller {
	/**
	 * @Route("/animais", name="listar_animais")
	 *
	 * @Template("animais/index.html.twig")
	 */
	public function index() {
		$em = $this->getDoctrine()->getManager();

		$animais = $em->getRepository(Animal::class)->findAll();


		return [
			'animais' => $animais
		];
	}

	/**
	 * @param Animal $animal
	 * @Route("/animais/visualizar/{id}", name="visualizar_animal")
	 *
	 * @Template("animais/view.html.twig")
	 * @return array
	 */
	public function view(Animal $animal) {


		return [
			'animal' => $animal
		];
	}

	/**
	 * @param Request $request
	 * @Route("animais/cadastrar", name="cadastrar_animal")
	 *
	 * @Template("animais/create.html.twig")
	 */
	public function create(Request $request) {

		$animal = new Animal();
		$form = $this->createForm(AnimalType::class, $animal);
		$form->handleRequest($request);

		if ($form -> isSubmitted() && $form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em -> persist($animal);
			$em -> flush();

			$this->addFlash('success', "Animal foi salvo ocm sucesso!");
			return $this->redirectToRoute('listar_animais');
		}

		return [
			'form' => $form->createView()
		];
	}
}
