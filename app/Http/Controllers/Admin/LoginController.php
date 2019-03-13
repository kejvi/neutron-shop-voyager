<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Njesia;
use TCG\Voyager\Http\Controllers\VoyagerAuthController;
use Validator;
use Illuminate\Http\Request;
use  Auth;

class LoginController extends  VoyagerAuthController {

    protected $username = 'username';

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }


}