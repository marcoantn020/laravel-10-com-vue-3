<?php

namespace App\Repositories;

class SalesRepository extends BaseRepository
{

    /**
     * @param $burgerName
     * @param $statusName
     * @return mixed
     */
    public function searchBurgerByNameAndStatus($burgerName, $statusName): mixed
    {
        return $this->model::whereHas('order', function ($query) use ($burgerName, $statusName) {
            $query->whereHas('burger', function ($query) use ($burgerName) {
                $query->where('name', $burgerName);
            })->whereHas('status', function ($query) use ($statusName) {
                $query->where('type', $statusName);
            });
        })->paginate(10);
    }

    /**
     * @param $burgerName
     * @param $statusName
     * @return mixed
     */
    public function searchBurgerByNameAndStatusWithBurgerName($burgerName, $statusName): mixed
    {
        return $this->model::select('sales.id', 'sales.order_id', 'burgers.name as burger_name', 'sales.created_at')
            ->whereHas('order', function ($query) use ($burgerName, $statusName) {
                $query->whereHas('burger', function ($query) use ($burgerName) {
                    $query->where('name', $burgerName);
                })->whereHas('status', function ($query) use ($statusName) {
                    $query->where('type', $statusName);
                });
            })
            ->join('orders', 'sales.order_id', '=', 'orders.id')
            ->join('burgers', 'orders.burger_id', '=', 'burgers.id')
            ->paginate(10);
    }

    /**
     * @return mixed
     */
    public function BurgersTraditionalWithStatusFinished(): mixed
    {
        return $this->model::whereHas('order', function ($query) {
            $query->whereHas('burger', function ($query)  {
                $query->where('name', 'Tradicional');
            })->whereHas('status', function ($query)  {
                $query->where('type', 'finalizado');
            });
        })->get()->toArray();
    }

    /**
     * @return mixed
     */
    public function BurgersArtesanalWithStatusFinished(): mixed
    {
        return $this->model::whereHas('order', function ($query) {
            $query->whereHas('burger', function ($query)  {
                $query->where('name', 'Artesanal');
            })->whereHas('status', function ($query)  {
                $query->where('type', 'finalizado');
            });
        })->get()->toArray();
    }
}
