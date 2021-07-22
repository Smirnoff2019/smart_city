<?php

namespace App\Http\Controllers\SmartCity;

use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\SmartCity\SmartCityController as SmartCityController;
use App\Models\User;

class SmartUserController extends SmartCityController
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(Request $request, User $user)
    {

        if(isset($request->email)) {
            if ($user = DB::table('users')->where('email', '=', $request->only('email'))->first())
            {
                return $this->sendResponse($user, 'User authorized successfully.');
            }
            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            $user->save();
            return $this->sendResponse($user, 'User register successfully.');
        }else{
            return $this->sendResponse([null], 'No user data.');
        }
            //return $this->get($user);
            //$user->create()->where($request->only(['name', 'email', 'phone']));
    }

    /**
     * @param User $user
     * @param $id
     * @return JsonResponse
     */
    public function show(User $user, $id)
    {
        $user = User::find($id);

        return $this->sendResponse($user, 'Point retrieved successfully.');
    }
}
