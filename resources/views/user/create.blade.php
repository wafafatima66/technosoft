
@extends('layouts.app')
@section('content')

    <h1>Create Post</h1>
      <div class="container">

        
    {!! Form::open(['action'=>'\App\Http\Controllers\PostsController@store','method'=>'POST','files' => true]) !!}
    @csrf
        {{Form ::label('title','Title')}}
        {{Form ::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
        {{Form ::label('body','Body')}}
        {{Form ::textarea('body','',['class'=>'form-control','placeholder'=>'Content'])}}
        {{Form ::file('cover_image')}}
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
      
    {!! Form::close() !!}


      </div>
            
@endsection


 

