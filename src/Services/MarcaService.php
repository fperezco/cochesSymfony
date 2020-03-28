<?php


namespace App\Services;


use App\Entity\Marca;
use App\Repository\MarcaRepository;
use Doctrine\ORM\EntityManagerInterface;

class MarcaService
{
    /**
     * @var MarcaRepository
     */
    private $marcaRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(MarcaRepository $marcaRepository,EntityManagerInterface $entityManager)
    {
        $this->marcaRepository = $marcaRepository;
        $this->entityManager = $entityManager;
    }

    public function getAll(){
        return $this->marcaRepository->findAll();
    }

    public function add($marca){
        $this->entityManager->persist($marca);
        $this->entityManager->flush();
    }

    public function update($marca){
        $this->entityManager->flush();
    }


    public function delete(Marca $marca){
        $this->entityManager->remove($marca);
        $this->entityManager->flush();
    }

    public function findById($id){
        return $this->marcaRepository->find($id);
    }

    /**
     * Devuelve los modelos existentes para una marca seleccionada
     * @param Marca $marca
     */
    public function getModelosFrom($marca){
        $modelos = $marca->getModelos();

        $responseArray = array();
        foreach($modelos as $modelo){
            $responseArray[] = array(
                "id" => $modelo->getId(),
                "nombre" => $modelo->getNombre()
            );
        }

        return $responseArray;
    }
}