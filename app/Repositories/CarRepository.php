<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository extends BaseRepository
{
    public function getModel()
    {
        return Car::class;

    }

    public function getList($request)
    {
        $cars = $this->_model->newQuery();

        if ($request->name) {
            $cars->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->state) {
            $cars->where('state', $request->state);
        }

        return $cars->paginate(10);

    }
}
