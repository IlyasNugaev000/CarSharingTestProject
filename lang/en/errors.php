<?php

use App\Exceptions\ApiException;

return [
    ApiException::HTTP_BAD_REQUEST => 'Bad request data',

    ApiException::USER_NOT_FOUND => 'User not found',
    ApiException::CAR_NOT_FOUND => "Car not found",
    ApiException::CAR_NOT_BELONG_USER => "Car does not belong to the user",
    ApiException::AVAILABLE_CARS_NOT_FOUND => "Available cars not found",
];
