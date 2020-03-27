<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ConcesionarioController
{

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/concesionarios",name="concesionario_index")
     */
    public function index(){
        return new Response("conce index");
    }

}