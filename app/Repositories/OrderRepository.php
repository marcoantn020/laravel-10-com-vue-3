<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderRepository extends BaseRepository
{

    /**
     * @return LengthAwarePaginator
     */
    public function getOrders(): LengthAwarePaginator
    {
        return $this->model
            ->with('status')
            ->paginate(10);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getOrderRequested(): LengthAwarePaginator
    {
          return $this->model
            ->with('status')
            ->where("status_id", "=", "1")
            ->paginate(10);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getOrderInProduction(): LengthAwarePaginator
    {
        return $this->model
            ->with('status')
            ->where("status_id", "=", "2")
            ->paginate(10);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getOrderFinished(): LengthAwarePaginator
    {
        return $this->model
            ->with('status')
            ->where("status_id", "=", "3")
            ->paginate(10);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getOrderCanceled(): LengthAwarePaginator
    {
        return $this->model
            ->with('status')
            ->where("status_id", "=", "4")
            ->paginate(10);
    }
}
