<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Repository\AuthRepository;
use Illuminate\Http\Request;


class AuthController extends Controller
{

public $auth;
    public function __construct(AuthRepository $auth)
    {

      $this->auth=$auth;
      $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function register(Request $request)
    {

    $this->auth->register($request);

    }



//=========================login
    public function login(Request $request)
    {
        $this->auth->login($request);

    }


//=====================logout
    public function logout(Request $request)
    {

        $this->auth->logout($request);

    }
}
