@extends('layouts.app')
@section('content')

    <h1>Create Post</h1>
      <div class="container">


    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id],'method'=>'Post','files' => true]) !!}
      <div class="form-group">
        {{form ::hidden('_method','PUT')}}
        {{form ::label('title','Title')}}
        {{form ::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
        {{form ::label('body','Body')}}
        {{form ::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Content'])}}
        {{Form ::file('cover_image')}}
        {{form::submit('Submit',['class'=>'btn btn-primary'])}}
      </div>
    {!! Form::close() !!}

      </div>
            
@endsection