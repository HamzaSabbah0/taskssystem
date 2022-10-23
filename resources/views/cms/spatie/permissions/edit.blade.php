@extends('cms.parent')

@section('title','edit category')
@section('page-title','Update Categroy')
@section('main-page-title','Home')
@section('small-page-title','update category')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update Category</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name ="name" placeholder="Enter name"
          value="{{$category->name}}">
        </div>
        <div class="form-group">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="active"
              @if($category->active) checked @endif>
              <label class="custom-control-label" for="active">Active</label>
            </div>
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="update({{$category->id}})" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
@endsection

@section('scripts')

  <script>

    function update(id)
        {
            axios.put('/cms/admin/categories/'+id,{
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
                // console.log(error);
                toastr.error(error.response.data.message);
            })
        }

  </script>

@endsection
