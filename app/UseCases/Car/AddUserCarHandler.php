<?php

declare(strict_types=1);

namespace App\UseCases\Car;

use App\Dto\DtoFactory;
use App\Models\Car;
use App\Repositories\Interfaces\CarRepositoryInterface;
use App\Services\CarService;
use App\UseCases\Car\Dto\AvailableCarsResultDto;

class AddUserCarHandler
{
    public function __construct(
        private CarRepositoryInterface $carRepository,
        private CarService $carService
    ) {
    }

    public function handle(string $userId, string $carId): void
    {
        $car = $this->carRepository->getCarById($carId);

        $this->carService->addUser($car, $userId);
    }
}
