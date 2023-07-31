<?php

namespace App\Service;

use App\Models\Bread;
use App\Models\Meat;
use App\Models\Optional;
use App\Repositories\BaseRepository;

class ServiceIngredients
{
    protected ?BaseRepository $breadRepository = null;
    protected ?BaseRepository $meatRepository = null;
    protected ?BaseRepository $optionalRepository = null;

    public function __construct()
    {
        $this->breadRepository = new BaseRepository(new Bread());
        $this->meatRepository = new BaseRepository(new Meat());
        $this->optionalRepository = new BaseRepository(new Optional());
    }

    public function ingredients(): array
    {
        $bread = $this->breadRepository->all();
        $meat = $this->meatRepository->all();
        $optional = $this->optionalRepository->all();

        return [
            "bread" => $bread,
            "meat" => $meat,
            "optional" => $optional
        ];
    }

}
