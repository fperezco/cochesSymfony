<?php


namespace App\Services;


use App\Entity\Concesionario;
use App\Repository\ConcesionarioRepository;
use Doctrine\ORM\EntityManagerInterface;

class ConcesionarioService
{
    /**
     * @var ConcesionarioRepository
     */
    private $concesionarioRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ConcesionarioRepository $concesionarioRepository,EntityManagerInterface $entityManager)
    {
        $this->concesionarioRepository = $concesionarioRepository;
        $this->entityManager = $entityManager;
    }

    public function getAll(){
        return $this->concesionarioRepository->findAll();
    }

    public function add($concesionario){
        $this->entityManager->persist($concesionario);
        $this->entityManager->flush();
    }

    public function update($concesionario){
        $this->entityManager->flush();
    }


    public function delete(Concesionario $concesionario){
        $this->entityManager->remove($concesionario);
        $this->entityManager->flush();
    }
}