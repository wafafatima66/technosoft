<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){
        $title = 'Welcome to Lsapp';
        //return view ('pages.index',compact('title'));
        return view('pages.index')->with('title',$title);
    }

    public function about(){
        $title = 'Welcome to About Page';
        return view('pages.about')->with('title',$title);
    }

    public function service(){
            $data = array(

                'title'=>'Services',
                'services'=> ['Web Design' , 'Graphic Design' , 'App Design']
            );
        return view ('pages.service')->with($data);
    }
}
