@extends('cms.parent')

@section('title','city')
@section('page-title','Update City')
@section('main-page-title','Home')
@section('small-page-title','update city')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update City</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{route('cities.update',$city->id)}}">
        @csrf
        @method('PUT')
      <div class="card-body">
        @if ($errors->any())

          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Validdation Error</h5>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
          </div>

        @endif
        @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
            {{session()->get('message')}}
          </div>
        @endif
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name ="name" placeholder="Enter name"
          value="@if(old('name')){{old('name')}}@else{{$city->name}} @endif">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
@endsection

