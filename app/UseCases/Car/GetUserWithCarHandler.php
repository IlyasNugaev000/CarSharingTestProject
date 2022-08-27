<?php

declare(strict_types=1);

namespace App\UseCases\Car;

use App\Dto\AbstractDto;
use App\Dto\DtoFactory;
use App\Exceptions\CarNotFoundException;
use App\Exceptions\UserNotFoundException;
use App\Models\Car;
use App\Repositories\Interfaces\CarRepositoryInterface;
use App\UseCases\Car\Dto\AvailableCarsResultDto;
use App\UseCases\Car\Dto\UserWithCarResultDto;

class GetUserWithCarHandler
{
    public function __construct(
        private CarRepositoryInterface $carRepository,
        private DtoFactory $dtoFactory
    ) {
    }

    public function handle(string $id): AbstractDto
    {
        $userWithCar = $this->carRepository->getUserWithCar($id);

        if ($userWithCar === null)
        {
            throw new UserNotFoundException();
        } elseif ($userWithCar->carName === null) {
            throw new CarNotFoundException();
        }

        return $this->dtoFactory->createDto(UserWithCarResultDto::class,
            [
                'userId' => $id,
                'userName' => $userWithCar->userName,
                'carId' => $userWithCar->carId,
                'carName' => $userWithCar->carName,
                'carStateNumber' => $userWithCar->carStateNumber
            ]
        );
    }
}
