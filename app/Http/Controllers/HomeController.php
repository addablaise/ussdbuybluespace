<?php

namespace App\Http\Controllers;

use App\Services\PhoneNumberService;
use App\Services\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $phoneNumberService; 
    protected $userService; 

    public function __construct(PhoneNumberService $phoneNumberService, UserService $userService)
    {
        config(['pagetitle' => trans('app.home')]);

        $this->phoneNumberService = $phoneNumberService;
        $this->userService = $userService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $param = (object) ['limit' => 10];
        $recent = $this->phoneNumberService->getAll($param);
        $count = $this->phoneNumberService->count();

        $users = $this->userService->count()->total;

        return view('home.index', [
            'users' => $users,
            'phones' => $count->total,
            'recent' => $recent,
            'active' => $count->active,
            'blacklisted' => $count->blocked,
        ]);
    }

}
