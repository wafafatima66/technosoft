@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (Session::get('role') == '1')
            <div class="row">
                @if (!empty($users) && sizeof($users) != 0)
                @foreach ($users as $user)
                <div class="card ml-2" style="width: 18rem;">
                    <img class="card-img-top"
                        src="{{(empty($user->image)) ? asset('images/noimage.png') : asset('images/'.$user->image)}}"
                        alt="Card image cap" style="width: 100%;height:200px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <a href="posts/user/{{ $user->id }}" class="btn btn-primary">EDIT PROFILE</a>
                    </div>
                </div>
                @endforeach
                @else
                No Data Found
                @endif
            </div>
            @endif


            {{-- @elseif(Session::get('role') == '2')
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
                    @if (!empty($posts) && sizeof($posts) != 0)
                    <table class="table mt-5">
                        <tr>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        
                        @foreach ($posts as $post)
                        <tr>
                            <th>{{$post->title}}</th>
                            <th> <a href="/posts/{{$post->id}}/edit" class="btn btn-success">EDIT</a></th>
                            <th> {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy',
                                $post->id],'method'=>'Post']) !!}
                                {{Form ::hidden('_method','DELETE')}}
                                {{form::submit('Delete',['class'=>'btn btn-danger'])}}
                                {!! Form::close() !!}</th>
                        </tr>
                        @endforeach
                       
                    </table>
                    @else
                    <h6 class="mt-5">No post</h6>
                     @endif
                </div>
            </div>
            @endif --}}

        </div>
    </div>
</div>
@endsection
