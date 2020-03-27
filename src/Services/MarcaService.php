<?php


namespace App\Services;


use App\Repository\MarcaRepository;

class MarcaService
{
    /**
     * @var MarcaRepository
     */
    private $marcaRepository;

    public function __construct(MarcaRepository $marcaRepository)
    {
        $this->marcaRepository = $marcaRepository;
    }

    public function getAll(){
        return $this->marcaRepository->findAll();
    }
}