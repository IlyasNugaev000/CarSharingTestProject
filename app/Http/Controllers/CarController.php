<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Exceptions\AvailableCarsNotFoundException;
use App\Exceptions\CarNotBelongUserException;
use App\Exceptions\CarNotFoundException;
use App\Exceptions\UserNotFoundException;
use App\UseCases\Car\AddUserCarHandler;
use App\UseCases\Car\DeleteUserCarHandler;
use App\UseCases\Car\GetAvailableCarsHandler;
use App\UseCases\Car\GetUserWithCarHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/available-cars",
     *     tags={"cars"},
     *     summary="Получение свободных автомобилей",
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(type="array",
     *             @OA\Items(ref="#/components/schemas/AvailableCarsResultDto")
     *         ),
     *     )
     * )
     *
     * @throws ApiException
     */
    public function getAvailableCars(GetAvailableCarsHandler $handler): Response
    {
        try {
            $resultDto = $handler->handle();
        } catch (AvailableCarsNotFoundException $e) {
            throw ApiException::generate(ApiException::AVAILABLE_CARS_NOT_FOUND);
        }

        return response()->api($resultDto);
    }

    /**
     * @OA\Get(
     *     path="/api/user/{id}/car",
     *     tags={"cars"},
     *     summary="Получение пользователя по id с машиной",
     *     @OA\Parameter(name="id", required=true, in="path"),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/UserWithCarResultDto")
     *     )
     * )
     *
     * @throws ApiException
     */
    public function getUserWithCar(string $id, GetUserWithCarHandler $handler): Response
    {
        try {
            $resultDto = $handler->handle($id);
        } catch (CarNotFoundException $e) {
            throw ApiException::generate(ApiException::CAR_NOT_FOUND);
        } catch (UserNotFoundException $e) {
            throw ApiException::generate(ApiException::USER_NOT_FOUND);
        }

        return response()->api($resultDto);
    }

    /**
     * @OA\Post(
     *     path="/api/user/{id}/car",
     *     tags={"cars"},
     *     summary="Добавление машины пользователю",
     *     @OA\RequestBody(
     *          request="LoginRequest",
     *          description="Auth request fields",
     *          @OA\JsonContent(
     *              type="object",
     *              required={"car_id"},
     *              @OA\Property(property="car_id", type="string", example="3")
     *          )
     *      ),
     *     @OA\Parameter(name="id", required=true, in="path"),
     *     @OA\Response(
     *         response="200",
     *         description="Success"
     *     )
     * )
     */
    public function addUserCar(string $id, Request $request, AddUserCarHandler $handler): Response
    {
        $handler->handle($id, $request['car_id']);

        return response()->api();
    }

    /**
     * @OA\Delete(
     *     path="/api/user/{id}/car/{car_id}",
     *     tags={"cars"},
     *     summary="Удаление машины у пользователя",
     *     @OA\Parameter(name="id", required=true, in="path"),
     *     @OA\Parameter(name="car_id", required=true, in="path"),
     *     @OA\Response(
     *         response="200",
     *         description="Success"
     *     )
     * )
     *
     * @throws ApiException
     */
    public function deleteUserCar(string $userId, string $carId, DeleteUserCarHandler $handler): Response
    {
        try {
            $handler->handle($userId, $carId);
        } catch (CarNotFoundException $e) {
            throw ApiException::generate(ApiException::CAR_NOT_FOUND);
        } catch (CarNotBelongUserException $e) {
            throw ApiException::generate(ApiException::CAR_NOT_BELONG_USER);
        }

        return response()->api();
    }
}
