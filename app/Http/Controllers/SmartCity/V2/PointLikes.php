<?php

namespace App\Http\Controllers\SmartCity\V2;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Http\Controllers\SmartCity\SmartCityController as SmartCityController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PointLikes extends SmartCityController
{
    /**
     * Display a listing of the resource.
     *
     * @param Point $point
     * @param int $id
     * @return JsonResponse
     */
    public function index(Point $point, int $id)
    {
        try
        {
            $point->find()->all()
                ->with($point->likes()->get());
                //->with($point->likes()->count());
//                ->with($point->users()->count()
//                    ->where('user_id', '==', User::class));

            //dd($point);
        }
        catch (\Throwable $e)
        {
            //return ['error' => ['message' => 'user undefined', 'id' => $id]];
        }

        return $this->sendResponse($point, 'User likes successfully displayed.');
    }
}
