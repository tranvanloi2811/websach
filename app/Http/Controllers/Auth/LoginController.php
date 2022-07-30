<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function index(){
        return view('auth.login_thu_vien');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){
        if(Auth()->user()->role == 1){
            // $id = Auth()->user()->id;
            return route('admin');
        }
        elseif(Auth()->user()->role == 0){
            return route('user');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request->all();
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        info($request);
        
        if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))) {
            $user = Auth::user();
            // $request->session()->put('profile-id', $user->id);
            // info(session('profile-id'));
            if(Auth()->user()->role == 1){
                // $id = Auth()->user()->id;
                return redirect()->route('admin');
            }
            elseif(Auth()->user()->role == 0){
                return redirect()->route('user');
            }
        }else {
            // dd($input);
            return redirect()->route('logins')->with('error','Email or Password are wrong');
        }
    }
}
