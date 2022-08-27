<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Car;

interface CarRepositoryInterface
{
    public function getAvailableCars(): ?iterable;

    public function getUserWithCar(string $id): ?Car;

    public function getCarById(string $id): ?Car;

    public function save(Car $car): void;
}
