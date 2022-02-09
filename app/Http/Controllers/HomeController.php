<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User ; 
use App\Models\Post ;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {  
        $userid = auth()->user()->id ; 
        $user = User::find($userid);
        $role = User::where('id', $userid)->value('role');
        $active = User::where('id', $userid)->value('active');
        $users = User::all()->except(Auth::id());
        Session::put('role', $role);
        if($role == '1'){
            return view('home')->with('posts',$user->posts)->with('users',$users);
        }else if($role == '2' && $active == '1'){
            $user = User ::find($userid);
            $posts = $user->posts()->get();
            return view('posts.index' , compact('posts','user'));
        }else {
            return redirect()->back()->with('error','Unauthorized access');
        }
        
    }
}
