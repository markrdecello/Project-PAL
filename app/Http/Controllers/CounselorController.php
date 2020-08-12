<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Counselor;
use Validator;
class CounselorController extends Controller
{


    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required',
            'birth_date' => 'nullable',
            'school' => 'nullable',
            'school_id' => 'nullable',
            'gender' => 'nullable',
            'phone_number' => 'nullable',
            'counselor_id' => 'nullable',
        ]);

          if ($validator->fails()) {
            $messages = $validator->errors();
            $arr = array("status" => 0, "message" => $messages->first());

            return json_encode($arr);

          }
          else {

            $name = $request->input("name");
            $email = $request->input("email");
            $password = md5($request->input("password"));
            $birth_date = $request->input("birth_date");
            $school = $request->input("school");
            $school_id = $request->input("school_id");
            $gender = $request->input("gender");
            $phone_number = $request->input("phone_number");
            $counselor_id = $request->input("counselor_id");

            $counselor = new Counselor;
            $counselor->name = $name;
            $counselor->email = $email;
            $counselor->password = $password;
            $counselor->birth_date = $birth_date;
            $counselor->school = $school;
            $counselor->school_id = $school_id;
            $counselor->gender = $gender;
            $counselor->phone_number = $phone_number;
            $counselor->counselor_id = $counselor_id;

            $counselor->save();

            //We want to give the app the user id back
            $arr = array("status" => 1, "message" => $counselor->id);
            return json_encode($arr);
          }
    }


    public function login(Request $request){
        $email = $request->input("email");
        $password = md5($request->input("password"));

        $counselor = Counselor::where("email", $email)->where("password", $password)->first();

        if($counselor){
            return ["status" => 1, "message" => $counselor->id, "role" => $counselor->role];
        } else {
            //No user found
            return ["status" => 0, "message" => "Information provided incorrect"];
        }
    }

    public function updateProfile($id, Request $request){

        $counselor = Counselor::find($id);

        if($counselor){

            $validator = Validator::make($request->all(), [
                'name' => 'nullable',
                'birth_date' => 'nullable',
                'school' => 'nullable',
                'school_id' => 'nullable',
                'grad_year' => 'nullable',
                'gender' => 'nullable',
                'phone_number' => 'nullable',
                'counselor_id' => 'nullable',
            ]);

            if ($validator->fails()) {
                $messages = $validator->errors();
                $arr = array("status" => 0, "message" => $messages->first());

                return json_encode($arr);

            } else {

                $name = $request->input("name");
                $birth_date = $request->input("birth_date");
                $school = $request->input("school");
                $school_id = $request->input("school_id");
                $gender = $request->input("gender");
                $phone_number = $request->input("phone_number");
                $counselor_id = $request->input("counselor_id");

                    //Im not proud, but im lazy
                if(isset($name)) { $counselor->name = $name; }
                if(isset($birth_date)) { $counselor->birth_date = $birth_date; }
                if(isset($school)) { $counselor->school = $school; }
                if(isset($school_id)) { $counselor->school_id = $school_id;}
                if(isset($gender)) { $counselor->gender = $gender;}
                if(isset($phone_number)) { $counselor->phone_number = $phone_number;}
                if(isset($counselor_id)) { $counselor->counselor_id = $counselor_id;}

                $counselor->save();

                //We want to give the app the user id back
                $arr = array("status" => 1, "message" => $counselor->id);
                return json_encode($arr);
            }
        }
        else{
            $arr = array("status" => 0, "message" => "user not found");
            return json_encode($arr);
        }
    }

    public function getProfile($id){
        $counselor = Counselor::find($id);
        return $counselor;
    }
}
