<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
class IndexController extends BaseController
{
    public function index(){
        return view('admin.index.index');
    }
    public function welcome(){
        return view('admin.index.welcome');
    }
}
