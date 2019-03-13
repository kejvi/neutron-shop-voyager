<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Njesia;
use Validator;
use Illuminate\Http\Request;
use  Auth;

class AdminController extends  \TCG\Voyager\Http\Controllers\Controller {

    public function changePassword(){

        return view('auth.change_password');
    }

    public function postChangePassword(Request $request){

        $this->validate($request,[
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required_if:password,present',
        ], [
            'password.required' => 'Password-i eshte i detyrueshem  ',
            'password.confirmed' => 'Password-et nuk jane njesoj ',
            'password.min' => 'Password-i duet te jete minimumi 4 karaktere',

        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return view('auth.change_password')->with('message', 'Success');
    }





}