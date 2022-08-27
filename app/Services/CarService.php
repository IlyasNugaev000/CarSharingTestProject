<?php

namespace App\Services;

use App\Models\Car;
use App\Repositories\Interfaces\CarRepositoryInterface;

class CarService
{
    public function __construct(
        private CarRepositoryInterface $carRepository
    ) {
    }

    public function addUser(
        Car $car,
        string $userId
    ) {
        $car->{Car::COL_USER_ID} = $userId;

        $this->carRepository->save($car);
    }

    public function deleteUserCar(
        Car $car
    ) {
        $car->{Car::COL_USER_ID} = null;

        $this->carRepository->save($car);
    }
}
