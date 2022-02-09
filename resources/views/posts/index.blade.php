@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="mx-auto">
            <img src="{{(empty($user->image)) ? asset('images/noimage.png') : asset('images/'.$user->image)}}" class=" text-center img-fluid" style="width: 200px;height:200px;border-radius:100%">
            <div class="text-center">
                <h3 class="text-center mt-2">{{ $user->name }}</h3>
                @if(Session::get('role') == '2' || Session::get('role') == '1')
                <a class="text-center mt-2" href="{{ route('user.edit',['user'=>$user->id] )}}">Edit Profile</a>
                     
                @endif
            </div>
            
        </div>
    </div>
</div>

    <h1>Posts</h1>
    
    <div class="row mt-2">
    @if(count($posts)>0)
        @foreach ($posts as $post)
                    <div class="card ml-2" style="width: 18rem;">
                        <img class="card-img-top"
                            src="{{(empty($post->cover_image)) ? asset('images/noimage.png') : asset('images/'.$post->cover_image)}}"
                            alt="Card image cap" style="width: 100%;height:200px">
                        <div class="card-body">
                            <a href="{{ route('posts.show',['post' => $post->id]) }}"><h3>{{$post->title}}</h3></a>
                            <small>Written On {{$post->created_at}}</small>
                            <br>
                            <small>Written By {{$post->user->name}}</small>
                        </div>
                        {{-- @if (!Auth::guest())
                    @if (Auth::user()->id == $post->user_id) --}}
                    @if(Session::get('role') == '2' || Session::get('role') == '1')
                    <div class="form-inline m-3">
                        <a href="{{ route('posts.edit',['post' => $post->id]) }}" class = "btn btn-success mr-2">EDIT</a>
                        {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id],'method'=>'Post']) !!}
                        {{Form ::hidden('_method','DELETE')}}
                        {{form::submit('Delete',['class'=>'btn btn-primary mr-2'])}}
                        {!! Form::close() !!}
                    </div>      
                @endif
                    </div>
        @endforeach

       
    </div>
    
    
           {{-- {{ $posts->links() }} --}}
    @else
        <p>No posts found</p>
        @endif

        @if(Session::get('role') == '2' || Session::get('role') == '1')
    <a href="{{ route('posts.create') }}" class="btn btn-primary mt-4 ">Add Post</a>
    
    @endif
    <a href="{{ url()->previous() }}" class="btn btn-danger mt-4 ml-3">Back</a>
   
@endsection