<?php

namespace App\Traits;

trait GeneralTrait
{

   

    public function returnError($errNum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    }


    public function returnSuccessMessage($msg = "", $errNum = "S000")
    {
        return [
            'status' => true,
            'succNum' => $errNum,
            'msg' => $msg
        ];
    }

    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'succNum' => "200",
            'msg' => $msg,
            $key => $value
        ]);
    }


    //////////////////
    public function returnValidationError($code = "E001", $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if ($input == "name")
            return 'E0011';

        else if ($input == "password")
            return 'E002';

        else if ($input == "title")
            return 'E003';

        else if ($input == "id")
            return 'E004';

        else if ($input == "new_password")
            return 'E005';

        else if ($input == "old_password")
            return 'E006';

        else if ($input == "confirm_password")
            return 'E007';

        else if ($input == "body")
            return 'E008';

        else if ($input == "author")
            return 'E009';

        else if ($input == "image")
            return 'E010';

        else if ($input == "email")
            return 'E011';

     

        else
            return "";
    }


}
