@extends('cms.parent')

@section('title','city')
@section('page-title','Create City')
@section('main-page-title','Home')
@section('small-page-title','create city')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create City</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{route('cities.store')}}">
        @csrf
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
          <input type="text" class="form-control" id="name" name ="name" placeholder="Enter name">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Store</button>
      </div>
    </form>
  </div>
@endsection

