@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="row">
                @if (!empty($users) && sizeof($users) != 0)
                @foreach ($users as $user)
                <div class="card ml-2" style="width: 18rem;">
                    <img class="card-img-top"
                        src="{{(empty($user->image)) ? asset('images/noimage.png') : asset('images/'.$user->image)}}"
                        alt="Card image cap" style="width: 100%;height:200px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <a href="posts/user/{{ $user->id }}" class="btn btn-primary">PROFILE</a>
                    </div>
                </div>
                @endforeach
                @else
                No Data Found
                @endif
            </div>


        </div>
    </div>
</div>
@endsection
