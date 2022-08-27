<?php

declare(strict_types=1);

namespace App\UseCases\Car;

use App\Dto\DtoFactory;
use App\Exceptions\AvailableCarsNotFoundException;
use App\Models\Car;
use App\Repositories\Interfaces\CarRepositoryInterface;
use App\UseCases\Car\Dto\AvailableCarsResultDto;

class GetAvailableCarsHandler
{
    public function __construct(
        private CarRepositoryInterface $carRepository,
        private DtoFactory $dtoFactory
    ) {
    }

    public function handle(): array
    {
        $availableCarsCollection = $this->carRepository->getAvailableCars();

        if ($availableCarsCollection->isEmpty()) {
            throw new AvailableCarsNotFoundException();
        }

        $resultDtoArray = [];

        /** @var Car $availableCar */
        foreach ($availableCarsCollection as $availableCar)
        {
            $resultDtoArray[] = $this->dtoFactory->createDto(AvailableCarsResultDto::class,
                [
                    'id' => $availableCar->getId(),
                    'name' => $availableCar->getName(),
                    'stateNumber' => $availableCar->getStateNumber()
                ]
            );
        }

        return $resultDtoArray;
    }
}
