<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\Http\Middleware\Admin;
use App\Http\Middleware\Admin;
use App\Models\User;
//use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
//use App\Http\Controllers\Admin\AdminLoginController;
use Request;
use Validator;

class AdminPanelController extends Controller
{
    /**
     * @return Factory|View
     */
    public function home()
    {
        return view('Admin.layout');
    }

    /**
     * @return Factory|View
     */
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $request, User $user)
    {
        $validator = Validator::make($request->toArray(), [
            'name' => 'required|string|min:6',
            'email'    => 'required|email|exists:users,email'
        ]);

        if ($validator->email = $user->isAdmin()) {
            return Admin::class;
        }else{
            return back()->login()->withErrors(['access' => 'Вам отказано в доступе!']);
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        //$this->guard()->logout();
        $request->session()->invalidate();
        //$request = Admin::class->Auth::logout();;

        return redirect()->route('Admin.login');
    }
}
