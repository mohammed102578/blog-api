<?php

namespace App\Interface;


interface ProfileInterface
{

    //=================get user profile
    public function get_profile($request);
   //=======================update_profile
    public function update_profile($request);
    //================change password
    public function change_password($request);
    //========================change user image
    public function change_image($request);




}
