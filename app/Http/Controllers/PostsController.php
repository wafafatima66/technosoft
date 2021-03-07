<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }


    public function index()
    {
        
        //$posts=Post::orderBy('title','desc')->paginate(1);
        $posts=Post::orderBy('title','desc')->get();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        
        $this->validate($request,[
            'title'=> 'required',
            'body'=>'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
          
        ]);

       if($request->hasFile('cover-image')){

       
       
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
            return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post :: find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized page');
        } else  return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'title'=> 'required',
            'body'=>'required'
        ]);
        
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        $extension=$request->file('cover_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'-'.time().'-'.$extension;
        $path = $request->file('cover_image')->move(public_path('images'),$fileNameToStore);

            $post=  Post :: find($id) ; 
            $post ->title = $request->input('title');
            $post ->body = $request->input('body');
            $post ->cover_image = $fileNameToStore ;

            $post->save();
            return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post = Post :: find($id);
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized page');
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
}
