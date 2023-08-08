<?php

namespace App\Repositories;

class BurgerRepository extends BaseRepository
{

    /**
     * @param $searchTerm
     * @return mixed
     */
    public function searchBurgerByName($searchTerm): mixed
    {
        return $this->model::where('name', 'LIKE', '%' . $searchTerm . '%')->paginate(10);
    }

}
