<?php

declare(strict_types=1);

namespace App\UseCases\Car\Dto;

use App\Dto\AbstractDto;

/**
 * @OA\Schema()
 */
class AvailableCarsResultDto extends AbstractDto
{
    /**
     * @OA\Property(example="1")
     */
    protected string $id;

    /**
     * @OA\Property(example="Ford Mustang")
     */
    protected string $name;

    /**
     * @OA\Property(property="state_number", example="х573кх")
     */
    protected string $stateNumber;
}
