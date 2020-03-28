<?php


namespace App\Controller;

use App\Entity\Concesionario;
use App\Form\ConcesionarioType;
use App\Services\ConcesionarioService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class ConcesionarioController
{

    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var ConcesionarioService
     */
    private $concesionarioService;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(
        Environment $twig,
        ConcesionarioService $concesionarioService,
        FormFactoryInterface $formFactory,
        RouterInterface $router
    ) {
        $this->twig = $twig;
        $this->concesionarioService = $concesionarioService;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    /**
     * @Route("/concesionarios",name="concesionario_index")
     */
    public function index()
    {
        $concesionarios = $this->concesionarioService->getAll();
        return new Response(
            $this->twig->render(
                'concesionario/index.html.twig',
                [
                    'concesionarios' => $concesionarios
                ]
            )
        );
    }

    /**
     * @Route("/concesionarios/add",name="concesionario_create")
     */
    public function add(Request $request)
    {
        $concesionario = new Concesionario();

        $form = $this->formFactory->create(ConcesionarioType::class, $concesionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->concesionarioService->add($concesionario);
            $request->getSession()->getFlashBag()->add("success", "Concesionario " . $concesionario->getDireccion() . " añadida");
            return new RedirectResponse($this->router->generate('concesionario_index'));
        }

        return new Response (
            $this->twig->render(
                'concesionario/add.html.twig',
                ['form' => $form->createView()]
            )
        );
    }


    /**
     * @Route("/concesionarios/{concesionario}/edit",name="concesionario_edit")
     */
    public function edit(Request $request, Concesionario $concesionario)
    {
        $form = $this->formFactory->create(ConcesionarioType::class, $concesionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->concesionarioService->update($concesionario);
            $request->getSession()->getFlashBag()->add("success", "Concesionario " . $concesionario->getDireccion() . " actualizada");
            return new RedirectResponse($this->router->generate('concesionario_index'));
        }

        return new Response (
            $this->twig->render(
                'concesionario/add.html.twig',
                ['form' => $form->createView()]
            )
        );
    }


    /**
     * @Route("/concesionario/{concesionario}/delete",name="concesionario_delete")
     * @param Concesionario $concesionario
     * @return Response
     */
    public function delete(Request $request, Concesionario $concesionario)
    {
        $this->concesionarioService->delete($concesionario);
        $request->getSession()->getFlashBag()->add("success", "Concesionario " . $concesionario->getDireccion() . " eliminada");
        return new RedirectResponse($this->router->generate('concesionario_index'));
    }


}