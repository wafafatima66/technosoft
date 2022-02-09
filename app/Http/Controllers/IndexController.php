<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $users = User::where('role', '!=', '1')->get();
        return view('index' , compact('users'));
    }
}
