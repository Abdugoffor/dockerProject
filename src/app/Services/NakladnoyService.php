<?php

namespace App\Services;

use App\Repositorys\NakladnoyRepository;

class NakladnoyService
{
    protected $nakladnoyRepository;

    public function __construct(NakladnoyRepository $nakladnoyRepository)
    {
        $this->nakladnoyRepository = $nakladnoyRepository;
    }

    public function getView($nakladnoy)
    {
        return $this->nakladnoyRepository->getView($nakladnoy);
    }
    public function getAll()
    {
        return $this->nakladnoyRepository->getAll();
    }

    public function storeNakladnoy($request)
    {
        return $this->nakladnoyRepository->storeNakladnoy($request);
    }
}
