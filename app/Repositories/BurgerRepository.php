<?php

namespace App\Repositories;

class BurgerRepository extends BaseRepository
{
    public function getBurger()
    {
        $data = $this->model
            ->with('status')
            ->get();
        return $this->format($data);
    }

    public function getOrderRequested(): array
    {
        $data = $this->model
            ->with('status')
            ->where("status_id", "=", "1")
            ->get();
        return $this->format($data);
    }

    public function getOrderInProduction(): array
    {
        $data = $this->model
            ->with('status')
            ->where("status_id", "=", "2")
            ->get();
        return $this->format($data);
    }

    public function getOrderFinished(): array
    {
        $data = $this->model
            ->with('status')
            ->where("status_id", "=", "3")
            ->get();
        return $this->format($data);
    }

    public function getOrderCanceled(): array
    {
        $data = $this->model
            ->with('status')
            ->where("status_id", "=", "4")
            ->get();
        return $this->format($data);
    }

    private function format($data): array
    {
        $new_array = [];
        if($data->count() > 0) {
            foreach ($data as $burger) {
                $new_array[] = [
                    "id" => $burger['id'],
                    "name" => $burger["name"],
                    "bread" => $burger["bread"],
                    "meat" => $burger["meat"],
                    "options" => $burger["options"],
                    "status" => $burger["status"]["type"],
                    "status_id" => $burger["status_id"]
                ];
            }
            return $new_array;
        }
        return [];
    }
}
