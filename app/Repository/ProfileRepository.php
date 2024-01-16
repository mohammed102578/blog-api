<?php

namespace App\Repository;

use App\Interface\ProfileInterface;
use App\Models\User;
use App\Traits\GeneralTrait;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileRepository implements ProfileInterface
{
    use GeneralTrait;


    /**
     * Create a new controller instance.
     *
     * @return void
     */


    //=================get user profile
    public function get_profile($request)
    {
        $user = User::find($request->id);
        if (!$user)
            return $this->returnError('001', 'this user not found');

        return $this->returnData('user', $user);

    }


    //=======================update_profile
    public function update_profile($request)
    {


        try{
        $rules = [
            "id" => "required",
            "name" => "required",
            'email' => 'required|unique:users,email,'.$request->id

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $user = User::find($request->id);

        if (!$user)
            return $this->returnError('001', 'this user not found');



        //update user

        $credentials = $request->only(['name', 'email']);

          $update=  $user->update($credentials);


        if (!$update){
            return $this->returnError('E010', 'updated failed');

        }else{
            return $this->returnData('user', $user,"updated successfully");  //return json response

        }




    } catch (\Exception $ex) {
        return $this->returnError($ex->getCode(), $ex->getMessage());
    }
    }




    //================change password
    public function change_password($request)
    {


        try{
        $rules = [
            "id" => "required",
            "old_password" => "required",
            'new_password'=>'required|alpha_num|min:6',
            'confirm_password'=>'required|same:new_password',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = User::find($request->id);

        if (!$user)
            return $this->returnError('001', 'this user not found');


          //check if request old_password equal current password
            if(!Hash::check($request->old_password,$user->password)){
                return $this->returnError('001', "Old Password Doesn't match!");

            }


            #Update the new Password
            $update= $user->update([
                'password' => Hash::make($request->new_password)
            ]);


        if (!$update){
            return $this->returnError('E010', 'updated failed');

        }else{
            return $this->returnData('user', $update,"updated successfuly");  //return json response

        }




    } catch (\Exception $ex) {
        return $this->returnError($ex->getCode(), $ex->getMessage());
    }
    }





//========================change user image
public function change_image($request)
{



   //validation image
    $rules = [
        "id" => "required",
        'image' =>'required|file|mimes:jpg,jpeg,png,gif|max:500000',


    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        $code = $this->returnCodeAccordingToInput($validator);
        return $this->returnValidationError($code, $validator);
    }


    //check if user exist
    $user = User::find($request->id);

    if (!$user)
        return $this->returnError('001', 'this user not found');


   //get full image path and store its in disk
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://");
    $actual_link.$_SERVER['HTTP_HOST'];
    $image=$request->image;
    $newimage = time().".".$image->clientExtension();
    $image->move('uploade/image', $newimage);


    $userImage =[

        'image' =>$actual_link.$_SERVER['HTTP_HOST'].'/uploade/image/'.$newimage,

    ];


    //start delete  image  from devic when update the image and just save the new image
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://");
    $replace=$actual_link.$_SERVER['HTTP_HOST']."/";
    $user = User::where(['id'=>$request->id])->select('image')->first();
    $image=$user->image;

    if($image !=null){
        $image_path= str_replace($replace,"",$image);

        if(file_exists($image_path)){
            unlink($image_path);
        }
    }


    //end delete file


       $update = User::where(['id'=>$request->id])->update($userImage);


       if (!$update){
        return $this->returnError('E010', 'updated failed');

    }else{
        return $this->returnData('user', $update,"updated successfuly");  //return json response

    }
    try{
} catch (\Exception $ex) {
    return $this->returnError($ex->getCode(), $ex->getMessage());
}
}




}
