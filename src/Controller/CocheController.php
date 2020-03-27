<?php

namespace App\Controller;

use App\Services\CocheService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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
     * CocheController constructor.
     */
    public function __construct(Environment $twig,CocheService $cocheService)
    {
        $this->twig = $twig;
        $this->cocheService = $cocheService;
    }


    /**
     * @Route("/coche", name="coche_index")
     */
    public function index()
    {
        return new Response("coche index");
       /* $coches = $this->cocheService->getAll();
        return new Response($this->twig->render('coche/index.html.twig',
            [
                'coches' => $coches
            ]));*/

    }
}
