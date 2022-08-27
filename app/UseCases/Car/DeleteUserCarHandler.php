<?php

declare(strict_types=1);

namespace App\UseCases\Car;

use App\Dto\DtoFactory;
use App\Exceptions\CarNotBelongUserException;
use App\Exceptions\CarNotFoundException;
use App\Models\Car;
use App\Repositories\Interfaces\CarRepositoryInterface;
use App\Services\CarService;
use App\UseCases\Car\Dto\AvailableCarsResultDto;

class DeleteUserCarHandler
{
    public function __construct(
        private CarRepositoryInterface $carRepository,
        private CarService $carService
    ) {
    }

    public function handle(string $userId, string $carId): void
    {
        $car = $this->carRepository->getCarById($carId);

        if ($car === null)
        {
            throw new CarNotFoundException();
        } elseif ($userId !== (string) $car->getUserId()) {
            throw new CarNotBelongUserException();
        }

        $this->carService->deleteUserCar($car);
    }
}
