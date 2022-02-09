@extends('layouts.app')
@section('content')


<div class="col-lg-8 mx-auto">

    <div class="card overflow-hidden no_border">
        <div class="tab-content">
            <div class="tab-pane fade show active ">
              {!! Form::open(['action' => ['App\Http\Controllers\UserController@update', $editData->id],'method'=>'Post','files' => true]) !!}
              {{form ::hidden('_method','PUT')}}
                <input type="hidden" name="user_id" id="user_id" value="{{$editData->id}}">
                <div class="card-body media align-items-center" style="border-bottom: none;">

                    <img src="{{(empty($editData->image)) ? asset('images/noimage.png') : asset('images/'.$editData->image)}}"
                        alt="" class="d-block ui-w-80" style="width: 300px;height:200px">

                    <div class="media-body ml-4">
                        <div>
                            <p
                                style="color: #8c8e90;margin-bottom: 9px;padding: 2px 0px;font-size: 18px;border-bottom: 1px solid #37343629;">
                                <strong>ID : </strong>{{isset($editData)? $editData->id : ''}}</p>
                        </div>
                        <label class="btn btn-outline-primary" for="image">
                            Upload new photo</label>
                            <input type="file"  name="image" id="image"
                                 accept="image/*" style="display: none" >
                            @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <span class="messages"><strong>{{ $errors->first('image') }}</strong></span>
                            </span>
                            @endif
                         &nbsp;

                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                            value="{{isset($editData)? $editData->name : ''}}" name="name">
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                            value="{{isset($editData)? $editData->email : ''}}" name="email">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('email') }}</strong></span>
                        </span>
                        @endif
                    </div>
@if ($editData->role=='1')
<div class="form-check">
    <input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" {{ ($editData->active=='1')? 'checked' : '' }} value="1">
    <label class="form-check-label" for="flexRadioDefault1">
      Active User
    </label>
  </div>

  <div class="form-check">
    <input class="form-check-input" type="radio" name="active" id="flexRadioDefault2"{{ ($editData->active=='0')? 'checked' : '' }} value="0">
    <label class="form-check-label" for="flexRadioDefault2">
      Inactive User
    </label>
  </div>
@endif
                    

                </div>
                <div class="mb-3 mr-4 text-center">
                    <button style="" type="submit" class="btn btn-primary  text-center ">Save changes</button>
                    <a href="{{ route('home') }}"  class="btn btn-danger">Back</a>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
