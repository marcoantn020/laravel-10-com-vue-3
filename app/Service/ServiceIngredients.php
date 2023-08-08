<?php

namespace App\Service;

use App\Models\Bread;
use App\Models\Meat;
use App\Models\Optional;
use App\Repositories\BaseRepository;
use App\Repositories\IngredientsRepository;

class ServiceIngredients
{
    protected ?IngredientsRepository $breadRepository = null;
    protected ?IngredientsRepository $meatRepository = null;
    protected ?IngredientsRepository $optionalRepository = null;

    public function __construct()
    {
        $this->breadRepository = new IngredientsRepository(new Bread());
        $this->meatRepository = new IngredientsRepository(new Meat());
        $this->optionalRepository = new IngredientsRepository(new Optional());
    }

    /**
     * @return array
     */
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
