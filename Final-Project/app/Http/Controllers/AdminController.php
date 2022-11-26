<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{

    public function signup(){
        return view('/pages/signup');
    }

    public function signupPost(Request $request)
    {
        Session::flush();
        $image = $request->file('user-image');
        $path = 'uploads/profile_images/';
        $name =  time() + rand(1, 9999999999999) . '.' . $image->getClientOriginalExtension();
        $fullPath = $path . $name;

        Storage::disk('public')->put($fullPath, file_get_contents($image));

        $status = Storage::disk('public')->exists($fullPath);

        if ($status) {
            $user = new AdminData();
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->password = $request['password'];
            $user->phone_number = $request['phone-number'];
            $user->visa_card = $request['visa-card'];
            $user->user_image = $fullPath;

            $result = $user->save();
            // // dd($result);
            return redirect('/login');
        } else {
            return redirect('/signup')->with('alert','Sign Up Not Success !!');
        }
    }

    public function login(){
        if(!Session::get('login')){
            return view('\pages\login');
        }
        return redirect('/show-stores');
    }

    public function loginPost(Request $request)
    {

        $username = $request->username;
        $password = $request->password;

        $userData = AdminData::where('username', $username)
        ->where('password', $password)
        ->first();

        if($userData){
            Session::put('id',$userData->id);
            Session::put('username',$userData->username);
            Session::put('password',$userData->password);
            Session::put('email',$userData->email);
            Session::put('phone_number',$userData->phone_number);
            Session::put('visa_card',$userData->visa_card);

            $img_link = Storage::disk('public')->url($userData->user_image);
            $userData->user_image = $img_link;

            Session::put('user_image',$userData->user_image);
            Session::put('login',TRUE);

            return redirect('/show-stores');
        }
        else{
            return redirect('/login')->with('alert','Password or Email, not exist!');
        }
    }

    public function logout(){
        if(!Session::get('login')){
            return view('\pages\login')->with('alert','you have login first');
        }
        Session::flush();
        return redirect('/login');
    }

}