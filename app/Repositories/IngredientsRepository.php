<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Repository Base With methods [all, find, create, update, delete]
 */
class IngredientsRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->model->get();
    }


}
