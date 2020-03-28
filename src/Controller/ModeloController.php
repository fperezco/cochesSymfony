<?php


namespace App\Controller;

use App\Entity\Marca;
use App\Entity\Modelo;
use App\Form\ModeloType;
use App\Services\MarcaService;
use App\Services\ModeloService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class ModeloController
{

    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var ModeloService
     */
    private $modeloService;
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
    /**
     * @var MarcaService
     */
    private $marcaService;

    public function __construct(
        Environment $twig,
        ModeloService $modeloService,
        MarcaService $marcaService,
        FormFactoryInterface $formFactory,
        RouterInterface $router
    ) {
        $this->twig = $twig;
        $this->modeloService = $modeloService;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->marcaService = $marcaService;
    }

    /**
     * @Route("/modelos",name="modelo_index")
     */
    public function index()
    {
        $modelos = $this->modeloService->getAll();
        return new Response(
            $this->twig->render(
                'modelo/index.html.twig',
                [
                    'modelos' => $modelos
                ]
            )
        );
    }

    /**
     * @Route("/modelos/add",name="modelo_create")
     */
    public function add(Request $request)
    {
        $modelo = new Modelo();
        $marcas = $this->marcaService->getAll();
        //dd($marcas);
        $form = $this->formFactory->create(ModeloType::class, $modelo ,array('marcas' => $marcas));


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->modeloService->add($modelo);
            $request->getSession()->getFlashBag()->add("success", "Modelo " . $modelo->getNombre() . " añadida");
            return new RedirectResponse($this->router->generate('modelo_index'));
        }

        return new Response (
            $this->twig->render(
                'modelo/add.html.twig',
                ['form' => $form->createView()]
            )
        );
    }


    /**
     * @Route("/modelos/{modelo}/edit",name="modelo_edit")
     */
    public function edit(Request $request, Modelo $modelo)
    {
        $marcas = $this->marcaService->getAll();
        $form = $this->formFactory->create(ModeloType::class, $modelo ,array('marcas' => $marcas));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->modeloService->update($modelo);
            $request->getSession()->getFlashBag()->add("success", "Modelo " . $modelo->getNombre() . " actualizada");
            return new RedirectResponse($this->router->generate('modelo_index'));
        }

        return new Response (
            $this->twig->render(
                'modelo/add.html.twig',
                ['form' => $form->createView()]
            )
        );
    }


    /**
     * @Route("/modelo/{modelo}/delete",name="modelo_delete")
     * @param Modelo $modelo
     * @return Response
     */
    public function delete(Request $request, Modelo $modelo)
    {
        $this->modeloService->delete($modelo);
        $request->getSession()->getFlashBag()->add("success", "Modelo " . $modelo->getNombre() . " eliminada");
        return new RedirectResponse($this->router->generate('modelo_index'));
    }





}