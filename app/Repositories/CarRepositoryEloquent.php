<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Car;
use App\Repositories\Interfaces\CarRepositoryInterface;

class CarRepositoryEloquent implements CarRepositoryInterface
{
    public function __construct
    (
       private Car $car
    ) {
    }

    public function getAvailableCars(): ?iterable
    {
        return $this->car->whereNull(Car::COL_USER_ID)->get();
    }

    public function getUserWithCar(string $id): ?Car
    {
        return $this->car
            ->where('users.id', $id)
            ->rightJoin('users', 'cars.user_id', '=', 'users.id')
            ->select(
                'users.name as userName',
                'cars.id as carId',
                'cars.name as carName',
                'cars.state_number as carStateNumber'
            )->first();
    }

    public function getCarById(string $id): ?Car
    {
        return $this->car->where('id', $id)->first();
    }

    public function save(Car $car): void
    {
        $car->save();
    }
}
