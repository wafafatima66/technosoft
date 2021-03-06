
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
        {{Form ::file('cover_image',['class'=>'mt-4 '])}}
        <div>
          {{Form::submit('Submit',['class'=>'btn btn-primary mt-4 '])}}
          <a href="{{ url()->previous() }}" class="btn btn-danger mt-4">Back</a>
        </div>
        
    {!! Form::close() !!}


      </div>
            
@endsection


 

