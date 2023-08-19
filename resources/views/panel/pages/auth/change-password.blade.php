@extends('panel.layout.app')

@section('page-title','change password')
@section('big-page-title','Change Password')
@section('main-page-title','Home')
@section('small-page-title','Password Setting')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Change Password</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-form">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="name">Current Password</label>
          <input type="password" class="form-control" id="current_password" placeholder="Enter current password">
        </div>
        <div class="form-group">
            <label for="name">New Password</label>
            <input type="password" class="form-control" id="new_password" placeholder="Enter new password">
          </div>
          <div class="form-group">
            <label for="name">Confiem New Password</label>
            <input type="password" class="form-control" id="new_password_confirmation" placeholder="Confirm new password">
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="updatePassword()" class="btn btn-primary">Change Password</button>
      </div>
    </form>
  </div>
@endsection

@push('scripts')

<script>

        function updatePassword()
        {
            axios.put('/panel/update-password',{
                current_password:document.getElementById('current_password').value,
                new_password:document.getElementById('new_password').value,
                new_password_confirmation:document.getElementById('new_password_confirmation').value
            })
            .then(function (response) {
                // handle success
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById('create-form').reset();
            })
            .catch(function (error) {
                // handle error
                console.log(error);
                toastr.error(error.response.data.message);
            })
        }

</script>

@endpush
