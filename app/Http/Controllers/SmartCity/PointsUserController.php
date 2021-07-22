<?php

namespace app\Http\Controllers\SmartCity;

use App\Http\Controllers\SmartCity\SmartCityController as SmartCityController;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PointsUserController extends SmartCityController
{
    /**
     * @param int $id
     * @return array|JsonResponse
     */
    public function getUsers(int $id)
    {
        /** @var Point $point */
        try
        {
            $point = Point::find($id);
            $user = $point->users()->get();
        }
        catch (\Throwable $e)
        {
            return ['error' => ['message' => 'point undefined', 'id' => $id]];
        }
        //return response()->json($user);
        return $this->sendResponse($user, 'User point successfully displayed.');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return array|JsonResponse
     */
    public function createUsers(Request $request, int $id)
    {
        /** @var Point $point */
        try {
            $point = Point::find($id);

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = $request->input('password');

            // Сохраняем связанную модель
            $point->users()->save($user);
        }catch (\Throwable $e)
        {
            return ['error' => ['message' => 'point undefined', 'id' => $id]];
        }

        return $this->sendResponse($user, 'Point user created successfully.');
    }

    /**
     * @param int $id
     * @return array|JsonResponse
     */
    public function deleteUser(int $id)
    {
        /** @var Point $point */
        try {
            $point = Point::find($id);
            $point->users()->delete();
        }
        catch (\Throwable $e)
        {
            return ['error' => ['message' => 'the point does not have user', 'id' => $id]];
        }

        return $this->sendResponse($point, 'User deleted successfully.');
    }
}
