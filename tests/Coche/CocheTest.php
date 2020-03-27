<?php

namespace App\Tests\Coche;

use App\Controller\CocheController;
use App\Entity\Coche;
use App\Services\CocheService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use phpDocumentor\Reflection\Types\Array_;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class CocheTest extends TestCase
{
    /**
     * test
     */
    public function test_create_basic_coche_default_not_vendido()
    {
        $car = new Coche();
        $car->setMatricula("1415BR");
        $car->setPrecio(1500);
        $this->assertTrue($car->getVendido()==false);
    }

  /*  public function test_listado_coches(){
        //given
        $twigMock = $this->getMockBuilder(Environment::class)
            ->disableOriginalConstructor() //evadimos tener que pasar mas depedencias...
            ->getMock();

        $cocheServiceMock = $this->getMockBuilder(CocheService::class)
            ->disableOriginalConstructor() //evadimos tener que pasar mas depedencias...
            ->getMock();

        $coche = new Coche();
        $coche->setPrecio(15);
        $coches = array($coche,$coche);
        $coches =  new ArrayCollection();
        $coches->add($coche);

        //expect
        //espero que se renderice esto
        $twigMock->expects($this->once())->method('render')
            ->with(
                'coche/index.html.twig',
                [
                    'coches' => $coches
                ]
            );
        //espero que se llame al getAll del servicio
        $cocheServiceMock->expects($this->once())->method('getAll');


        $cochesController  = new CocheController($twigMock,$cocheServiceMock);
        $cochesController->index();
        //then
    }*/
}
