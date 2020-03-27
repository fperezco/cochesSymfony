<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ModeloController
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
     * @Route("/modelos",name="modelo_index")
     */
    public function index(){
        return new Response("modelo index");

    }

}