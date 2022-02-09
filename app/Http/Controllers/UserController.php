<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        //
    }

 
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit')->with('editData',$user);
    }

    public function update(Request $request, $id)
    {
        
        if($request->file('image')){
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        $extension=$request->file('image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'-'.time().'-'.$extension;
        $path = $request->file('image')->move(public_path('images'),$fileNameToStore);
        }else {
            $fileNameToStore = User::where('id', $id)->value('image');
        }

        if($request->input('active')){
            $active = $request->input('active');
        }else {
            $active = User::where('id', $id)->value('active');
        }

            $user=  User::find($id) ; 
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->active = $active;
            $user->image = $fileNameToStore ;
            $user->save();

            return redirect()->back()->with('success','User Updated');
    }

   
    public function destroy($id)
    {
        //
    }
}
