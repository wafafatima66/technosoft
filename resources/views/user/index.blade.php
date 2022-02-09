@extends('layouts.app')
@section('content')
    <h1>Posts</h1>

    @if(count($posts)>0)
        @foreach ($posts as $post)
            
                <div class="row mt-2">
                    <div class="col-3">
                        <img src="{{asset('images/'.$post->cover_image)}}" alt="" style="width: 100%;height:200px">
                    </div>
                    <div class="col-6">
                        <a href="/posts/{{$post->id}} "><h3>{{$post->title}}</h3></a>
                        <small>Written On {{$post->created_at}}</small>
                        <br>
                        <small>Written By {{$post->user->name}}</small>
                    </div>
            </div>
        @endforeach

       

           {{-- {{ $posts->links() }} --}}

        

    @else
        <p>No posts found</p>
        @endif
   
@endsection