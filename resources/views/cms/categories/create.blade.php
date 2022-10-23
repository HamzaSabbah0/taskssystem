@extends('cms.parent')

@section('title','create category')
@section('page-title','Create Category')
@section('main-page-title','Home')
@section('small-page-title','create category')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Category</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-form">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="active">
              <label class="custom-control-label" for="active">Active</label>
            </div>
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="store()" class="btn btn-primary">Store</button>
      </div>
    </form>
  </div>
@endsection

@section('scripts')

<script>

        function store()
        {
            axios.post('/cms/admin/categories',{
                name:document.getElementById('name').value,
                active:document.getElementById('active').checked
            })
            .then(function (response) {
                // handle success
                console.log(response);
                toastr.success(response.data.message);
                window.location.href = "/cms/admin/categories";
            })
            .catch(function (error) {
                // handle error
                console.log(error);
                toastr.error(error.response.data.message);
            })
        }

</script>

@endsection
