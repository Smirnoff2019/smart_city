<?php


namespace app\Http\Controllers\Admin;


use App\Http\Middleware\Admin;
use App\Models\User;
use Auth;
use Request;
use Validator;

class AdminLoginController extends AdminPanelController
{
//    protected $redirectTo = '/admin';
//    protected $redirectAfterLogout = '/admin';
//
//    public function __construct()
//    {
//        $this->middleware('guest', ['except' => 'logout']);
//    }
//
//    public function showLoginForm()
//    {
//        return view('login');
//    }
//    protected function guard()
//    {
//        return Auth::guard('admin');
//    }

    /**
     * @param Request $request
     * @param User $user
     * @return string
     */
    public function getAdminLogin(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6',
            'email'    => 'required|email|exists:users,email'
        ]);

        if ($validator->email = $user->isAdmin()) {
            return $user->isAdmin();
        }else{
            return redirect()->route('login')->withErrors(['access' => 'Вам отказано в доступе!']);
        }
    }
//
//    public function adminLogout()
//    {
//        $this->isAdmin()->logout();
//    }
}
