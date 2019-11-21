<?php

namespace App\Http\Controllers\Index;
use Illuminate\Support\Facades\Cache;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view("index.user.user");
    }
}
