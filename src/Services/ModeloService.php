<?php


namespace App\Services;


use App\Entity\Modelo;
use App\Repository\ModeloRepository;
use Doctrine\ORM\EntityManagerInterface;

class ModeloService
{
    /**
     * @var ModeloRepository
     */
    private $modeloRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ModeloRepository $modeloRepository,EntityManagerInterface $entityManager)
    {
        $this->modeloRepository = $modeloRepository;
        $this->entityManager = $entityManager;
    }

    public function getAll(){
        return $this->modeloRepository->findAll();
    }

    public function add($modelo){
        $this->entityManager->persist($modelo);
        $this->entityManager->flush();
    }

    public function update($modelo){
        $this->entityManager->flush();
    }


    public function delete(Modelo $modelo){
        $this->entityManager->remove($modelo);
        $this->entityManager->flush();
    }
}