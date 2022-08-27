<?php

declare(strict_types=1);

namespace App\UseCases\Car\Dto;

use App\Dto\AbstractDto;

/**
 * @OA\Schema()
 */
class UserWithCarResultDto extends AbstractDto
{
    /**
     * @OA\Property(property="user_id", example="1")
     */
    protected string $userId;

    /**
     * @OA\Property(property="user_name", example="Ильяс")
     */
    protected string $userName;

    /**
     * @OA\Property(property="car_id", example="2")
     */
    protected string $carId;

    /**
     * @OA\Property(property="car_name", example="Ford Mustang")
     */
    protected string $carName;

    /**
     * @OA\Property(property="car_state_number", example="х573кх")
     */
    protected string $carStateNumber;
}
