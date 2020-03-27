<?php


namespace App\Controller;


use App\Entity\Marca;
use App\Form\MarcaType;
use App\Repository\MarcaRepository;
use App\Services\MarcaService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class MarcaController
{

    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var MarcaService
     */
    private $marcaService;
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
        MarcaService $marcaService,
        FormFactoryInterface $formFactory,
        RouterInterface $router
    ) {
        $this->twig = $twig;
        $this->marcaService = $marcaService;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    /**
     * @Route("/marcas",name="marca_index")
     */
    public function index()
    {
        $marcas = $this->marcaService->getAll();
        return new Response(
            $this->twig->render(
                'marca/index.html.twig',
                [
                    'marcas' => $marcas
                ]
            )
        );
    }

    /**
     * @Route("/marcas/add",name="marca_create")
     */
    public function add(Request $request)
    {
        $marca = new Marca();

        //$form = $this->createForm(MicroPostType::class, $microPost);
        $form = $this->formFactory->create(MarcaType::class, $marca);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->marcaService->add($marca);
            $request->getSession()->getFlashBag()->add("success", "Marca " . $marca->getNombre() . " añadida");
            return new RedirectResponse($this->router->generate('marca_index'));
        }

        return new Response (
            $this->twig->render(
                'marca/add.html.twig',
                ['form' => $form->createView()]
            )
        );
    }


    /**
     * @Route("/marca/{marca}/delete",name="marca_delete")
     * @param Marca $marca
     * @return Response
     */
    public function delete(Request $request, Marca $marca)
    {
        $this->marcaService->delete($marca);
        $request->getSession()->getFlashBag()->add("success", "Marca " . $marca->getNombre() . " eliminada");
        return new RedirectResponse($this->router->generate('marca_index'));
    }


    /**
     * @Route("marca/test",name ="marca_test")
     */
    public function test()
    {
        try {
            $marca = new Marca();
            $marca->setNombre("fail");
        } catch (Exception $e) {
            return new Response($e->getMessage());
            //$form->addError(new FormError($e->getMessage()));
        }
    }

}