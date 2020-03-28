<?php


namespace App\Services;


use App\Entity\Coche;
use App\Repository\CocheRepository;
use Doctrine\ORM\EntityManagerInterface;

class CocheService
{
    /**
     * @var CocheRepository
     */
    private $cocheRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(CocheRepository $cocheRepository,EntityManagerInterface $entityManager)
    {
        $this->cocheRepository = $cocheRepository;
        $this->entityManager = $entityManager;
    }

    public function getAll(){
        return $this->cocheRepository->findAll();
    }

    public function add($coche){
        $this->entityManager->persist($coche);
        $this->entityManager->flush();
    }

    public function update($coche){
        $this->entityManager->flush();
    }


    public function delete(Coche $coche){
        $this->entityManager->remove($coche);
        $this->entityManager->flush();
    }
}