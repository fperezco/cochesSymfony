<?php


namespace App\Services;


use App\Repository\CocheRepository;

class CocheService
{
    /**
     * @var CocheRepository
     */
    private $cocheRepository;

    public function __construct(CocheRepository $cocheRepository)
    {
        $this->cocheRepository = $cocheRepository;
    }

    public function getAll(){
        return $this->cocheRepository->findAll();
    }

}