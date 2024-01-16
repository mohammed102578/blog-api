<?php

namespace App\Interface;



interface AuthInterface
{


    public function register($request);

//=========================login
    public function login($request);

//=====================logout
    public function logout($request);

}
