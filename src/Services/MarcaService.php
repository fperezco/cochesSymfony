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

    public function delete(Marca $marca){
        $this->entityManager->remove($marca);
        $this->entityManager->flush();
    }
}