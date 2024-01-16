<?php

namespace App\Http\Controllers\API;

use App\Repository\ProfileRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public $profile;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProfileRepository $profile)
    {
        $this->profile = $profile;
        $this->middleware('auth:api');
    }


    //=================get user profile
    public function get_profile(Request $request)
    {
        $this->profile->get_profile($request);
    }


    //=======================update_profile
    public function update_profile(Request $request)
    {
        $this->profile->update_profile($request);
    }


    //================change password
    public function change_password(Request $request)
    {
        $this->profile->change_password($request);
    }


    //========================change user image
    public function change_image(Request $request)
    {
        $this->profile->change_image($request);
    }
}
