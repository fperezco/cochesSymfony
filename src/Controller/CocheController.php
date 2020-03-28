<?php


namespace App\Controller;

use App\Entity\Coche;
use App\Form\CocheType;
use App\Services\ConcesionarioService;
use App\Services\MarcaService;
use App\Services\CocheService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class CocheController
{

    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var CocheService
     */
    private $cocheService;
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
    /**
     * @var ConcesionarioService
     */
    private $concesionarioService;

    public function __construct(
        Environment $twig,
        CocheService $cocheService,
        MarcaService $marcaService,
        ConcesionarioService $concesionarioService,
        FormFactoryInterface $formFactory,
        RouterInterface $router
    ) {
        $this->twig = $twig;
        $this->cocheService = $cocheService;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->marcaService = $marcaService;
        $this->concesionarioService = $concesionarioService;
    }

    /**
     * @Route("/coches",name="coche_index")
     */
    public function index()
    {
        $coches = $this->cocheService->getAll();
        return new Response(
            $this->twig->render(
                'coche/index.html.twig',
                [
                    'coches' => $coches
                ]
            )
        );
    }

    /**
     * @Route("/coches/add",name="coche_create")
     */
    public function add(Request $request)
    {
        $coche = new Coche();
        $marcas = $this->marcaService->getAll();
        $concesionarios = $this->concesionarioService->getAll();

//        $form = $this->formFactory
//            ->create(CocheType::class, $coche ,
//                     array(
//                         'marcas' => $marcas,
//                         'concesionarios' => $concesionarios
//                     ));

        $form = $this->formFactory
            ->create(CocheType::class, $coche);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->cocheService->add($coche);
            $request->getSession()->getFlashBag()->add("success", "Coche " . $coche->getMatricula() . " añadida");
            return new RedirectResponse($this->router->generate('coche_index'));
        }

        return new Response (
            $this->twig->render(
                'coche/add.html.twig',
                ['form' => $form->createView()]
            )
        );
    }


    /**
     * @Route("/coches/{coche}/edit",name="coche_edit")
     */
    public function edit(Request $request, Coche $coche)
    {
        //$marcas = $this->marcaService->getAll();

        //$form = $this->formFactory->create(CocheType::class, $coche ,array('marcas' => $marcas));
        $form = $this->formFactory->create(CocheType::class, $coche);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->cocheService->update($coche);
            $request->getSession()->getFlashBag()->add("success", "Coche " . $coche->getMatricula() . " actualizada");
            return new RedirectResponse($this->router->generate('coche_index'));
        }

        return new Response (
            $this->twig->render(
                'coche/add.html.twig',
                ['form' => $form->createView()]
            )
        );
    }


    /**
     * @Route("/coche/{coche}/delete",name="coche_delete")
     * @param Coche $coche
     * @return Response
     */
    public function delete(Request $request, Coche $coche)
    {
        $this->cocheService->delete($coche);
        $request->getSession()->getFlashBag()->add("success", "Coche " . $coche->getMatricula() . " eliminada");
        return new RedirectResponse($this->router->generate('coche_index'));
    }


}