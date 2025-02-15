<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function checkMobile(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
        ]);

        $user = User::where('mobile_no', $request->mobile)->first();

        if ($user) {
            return Util::getSuccessMessageWithToken('User Logged In', $user, $user->createToken('token')->plainTextToken);;
        } else {
            $data = [
                "mobile" => $request->mobile,
                "role" => "patient",
                "exist" => false
            ];
            return Util::getErrorMessage('Patient Not found', $data);
        }
    }

    public function checkPassword(Request $request)
    {
        try {
            $request->validate([
                'mobile' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('mobile_no', $request->mobile)->first();
            if (!$user) {
                return Util::getErrorMessage('User Not Found');
            }
            if (Hash::check($request->password, $user->password)) {
                return Util::getSuccessMessageWithToken('User Logged In', $user, $user->createToken('token')->plainTextToken);
            } else {
                return Util::getErrorMessage('Invalid Password');
            }
        } catch (\Exception $e) {
            return Util::getErrorMessage($e->getMessage());
        }
    }

    public function checkBirthDate(Request $request)
    {
        try {
            $request->validate([
                'mobile' => 'required',
                'birth_date' => 'required',
            ]);

            $user = User::where('mobile_no', $request->mobile)->first();
            if (!$user) {
                return Util::getErrorMessage('User Not Found');
            }
            if ($user->dob == $request->birth_date) {
                return Util::getSuccessMessageWithToken('User Logged In', $user, $user->createToken('token')->plainTextToken);
            } else {
                return Util::getErrorMessage('Invalid Birth Date');
            }
        } catch (\Exception $e) {
            return Util::getErrorMessage($e->getMessage());
        }
    }

    public function newPatient(Request $request)
    {
        try {
            $request->validate([
                'mobile' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'birth_date' => 'required',
            ]);

            $user = User::where('mobile_no', $request->mobile)->first();
            if (!$user) {
                $user = new User();
                $user->branch_id = $request->branch_id;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile_no = $request->mobile;
                $user->password = Hash::make(123456);
                $user->address = $request->address;
                $user->dob = $request->birth_date;
                $user->save();
                return Util::getSuccessMessageWithToken('User Created Successfully', $user, $user->createToken('token')->plainTextToken);
            } else {
                return Util::getErrorMessage('User Already Exist', $user);
            }
        } catch (\Exception $e) {
            return Util::getErrorMessage($e->getMessage());
        }
    }

    public function updateLang(Request $request)
    {
        try {
            $user = User::where('id', Auth::user()->id)->first();
            $user->language = $request->lang;
            $user->save();
            return Util::getSuccessMessage('Language Updated Successfully', $user);
        } catch (\Exception $e) {
            return Util::getErrorMessage($e->getMessage());
        }
    }

    public function profileUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'branch_id' => 'required',
                'address' => 'required',
                'dob' => 'required',
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 422);
            }
            $user = User::where('id', Auth::user()->id)->first();
            $user->name = $request->name;
            $user->branch_id = $request->branch_id;
            $user->address = $request->address;
            $user->dob  = $request->dob;
            $user->email = $request->email;
            $user->save();

            return Util::getSuccessMessage('Profile Updated Successfully', $user);
        } catch (\Exception $e) {
            return Util::getErrorMessage($e->getMessage());
        }
    }
}
