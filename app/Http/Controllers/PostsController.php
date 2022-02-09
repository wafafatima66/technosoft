<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use DB;

class PostsController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }


    public function index($id)
    {
        // $id = auth()->user()->id ; 
        $user = User ::find($id);
        $posts = $user->posts()->get();
        return view('posts.index' , compact('posts','user'));
    }

    public function create()
    {
        return view('posts.create');
    }

  
    public function store (Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'body'=>'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

       if($request->hasFile('cover_image')){
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        $extension=$request->file('cover_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'-'.time().'-'.$extension;
        $path = $request->file('cover_image')->move(public_path('images'),$fileNameToStore);
       } else {
        $fileNameToStore='noimage.png';
       }
            $post=  new post ; 
            $post ->title = $request->input('title');
            $post ->body = $request->input('body');
            $post ->cover_image = $fileNameToStore ;
            $post->user_id = auth()->user()->id;
            $post->save();
            // return redirect('/posts')->with('success','Post Created');
            return redirect()->back()->with('success','Post Created');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    public function edit($id)
    {
        $post = Post :: find($id);
        // if(auth()->user()->id !== $post->user_id){
        //     return redirect()->back()->with('error','Unauthorized page');
        // } else  
        return view('posts.edit')->with('post',$post);
    }

   
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'title'=> 'required',
            'body'=>'required'
        ]);
        
        if($request->file('cover_image')){
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        $extension=$request->file('cover_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'-'.time().'-'.$extension;
        $path = $request->file('cover_image')->move(public_path('images'),$fileNameToStore);
    }else {
        $fileNameToStore = Post::where('id', $id)->value('cover_image');
    }
            $post=  Post::find($id) ; 
            $post ->title = $request->input('title');
            $post ->body = $request->input('body');
            $post ->cover_image = $fileNameToStore ;

            $post->save();
            // return redirect('/posts')->with('success','Post Updated');
            return redirect()->back()->with('success','Post Updated');
    }

   
    public function destroy($id)
    {
        
        $post = Post :: find($id);
        if(auth()->user()->id !==$post->user_id){
            return redirect()->back()->with('error','Unauthorized page');
        }
        $post->delete();
        return redirect()->back()->with('success','Post Removed');
    }
}
