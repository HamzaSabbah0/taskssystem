@extends('cms.parent')

@section('title','user')
@section('page-title','Update User')
@section('main-page-title','Home')
@section('small-page-title','update user')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update User</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter name"
          value="@if(old('name')){{old('name')}}@else{{$user->name}} @endif">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email"
            value="@if(old('email')){{old('email')}}@else{{$user->email}} @endif">
          </div>
        <div class="form-group">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="active"
              @if($user->active) checked @endif>
              <label class="custom-control-label" for="active">Active</label>
            </div>
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="update({{$user->id}},
        '{{$user->id != auth('user')->id()}}')" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
@endsection

@section('scripts')

  <script>

    function update(id , redirect)
        {
            axios.put('/cms/admin/users/'+id,{
                name:document.getElementById('name').value,
                email:document.getElementById('email').value,
                active:document.getElementById('active').checked
            })
            .then(function (response) {
                // handle success
                console.log(response);
                toastr.success(response.data.message);
                if(redirect){
                    window.location.href = "/cms/admin/users";
                }
            })
            .catch(function (error) {
                // handle error
                // console.log(error);
                toastr.error(error.response.data.message);
            })
        }

  </script>

@endsection

