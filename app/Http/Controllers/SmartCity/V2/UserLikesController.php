<?php

namespace App\Http\Controllers\SmartCity\V2;

use App\Http\Controllers\SmartCity\SmartCityController as SmartCityController;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserLikesController extends SmartCityController
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @param int $id
     * @return array
     */
    public function index(User $user, int $id)
    {
        try
        {
            $user = User::find($id)
                ->likes()
                ->get();
            //dd($user);
        }
        catch (\Throwable $e)
        {
            return ['error' => ['message' => 'user undefined', 'id' => $id]];
        }

        return $this->sendResponse($user, 'User likes successfully displayed.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function create(Request $request, int $id)
    {
        try
        {
            $user = User::find($id);

            $like = new Like();
            $like->point_id = $request->input('point_id');
            $like->level = $request->input('level');
            $like->user_id = $id;

            // Сохраняем связанную модель
            $user->likes()->save($like);
            //dd($like);
        }
        catch (\Throwable $exception)
        {
//            throw new NotFoundHttpException($exception, [
//                "class" => __CLASS__,
//                "line" => __LINE__
//            ]);
        }
        //dd($like);
        return $this->sendResponse($like, 'User likes successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $user_id
     * @param int $id
     * @return JsonResponse|Response
     */
    public function destroy(int $user_id, int $id)
    {
        $user = User::find($user_id)
            ->likes(Like::find($id)
                ->where('user_id', '=', $user_id))
            ->delete();
        return $this->sendResponse($user, 'User deleted like successfully.');
    }
}
