<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    protected $logService; 

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    
    /**
     * Login Form
     *
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('auth.login');
    }

    /**
     * Login User
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'rememeber' => 'nullable'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'deleted_at' => NULL], $request->rememeber))
        {
            //Log Action
            $data = (object) array('user_id' => auth()->id(), 'action' => "Login");
            $this->logService->create($data);
            
            return redirect()->intended($this->redirectPath());
        }
        else
        {
            return redirect('login')
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => trans('auth.failed')
                ])->with('error', trans('auth.failed'));
        }
    }

    /**
     * Logout User
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        //Log Action
        $data = (object) array('user_id' => auth()->id(), 'action' => "Logout");
        $this->logService->create($data);
        
        //Logout
        Auth::logout();
        
        return redirect('login');
    }

    /**
     * Display profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        config(['pagetitle' => trans('app.profile')]);

        return view('auth.profile');
    }

    /**
     * Display a listing of the logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function logs()
    {
        config(['pagetitle' => trans('app.activities')]);

        $logs = $this->logService->getByUserId(auth()->id());
        return view('auth.logs', ['logs' => $logs]);
    }

}
