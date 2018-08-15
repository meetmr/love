<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function userInfo(){
        return view('admin.user.user-Info');
    }
}
