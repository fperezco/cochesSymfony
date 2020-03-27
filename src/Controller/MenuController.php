<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class MenuController
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
     * @Route("/",name="main")
     */
    public function mainMenu(){
        //return new Response("hola");
         return new Response($this->twig->render('main/main.html.twig'));
    }
}