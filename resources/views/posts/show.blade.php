@extends('layouts.app')
@section('content')

<img src="{{asset('images/'.$post->cover_image)}}" alt="" style="width: 100%;height:300px">
    <h1>{{$post->title}}</h1>
    <p>Written On {{$post->created_at}}</p>
    <p>Written By {{$post->user->name}}</p>
    <p>{{$post->body}}</p>
            <div>
                @if (!Auth::guest())
                    @if (Auth::user()->id == $post->user_id)
                    <div class="form-inline">
                        <a href="{{ route('posts.edit',['post' => $post->id]) }}" class = "btn btn-success mr-2">EDIT</a>
                        {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id],'method'=>'Post']) !!}
                        {{Form ::hidden('_method','DELETE')}}
                        {{form::submit('Delete',['class'=>'btn btn-primary mr-2'])}}
                        {!! Form::close() !!}
                    @endif      
                @endif
                <a href="{{ url()->previous() }}" class="btn btn-danger ">Back</a>
            </div>
            </div>
@endsection