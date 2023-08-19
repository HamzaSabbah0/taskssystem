@extends('panel.layout.app')

@section('page-title','category')
@section('big-page-title','Category Information')
@section('main-page-title','Home')
@section('small-page-title','index')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Category Info.</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover table-bordered table-striped text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Setting</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    {{-- <td>@if($category->active) Active @else Disabled @endif</td> --}}
                    {{-- <td>{{$category->status}}</td> --}}
                    <td><span class="badge @if($category->active) bg-success @else bg-danger @endif">{{$category->status}}</span></td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info">
                              <i class="fas fa-edit"></i>
                            </a>
                            {{-- <form method="POST" action="{{route('cities.destroy',$city->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                                </button>
                            </form> --}}
                            <a href="#" class="btn btn-danger"
                            onclick="confirmDestroy({{$category->id}},this)">
                                <i class="fas fa-trash"></i>
                            </a>
                          </div>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

@endsection

@section('scripts')

 <script>

    function confirmDestroy(id,referance)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                destroy(id,referance);
            }
            })
    }
    function destroy(id,referance)
    {
        axios.delete('/panel/categories/'+id)
        .then(function (response) {
            // handle success
            console.log(response);
            referance.closest('tr').remove();
            showMessage(response.data)
        })
        .catch(function (error) {
            // handle error
            console.log(error);
            showMessage(error.response.data)
        })
    }
    function showMessage(data)
    {
        Swal.fire({
            icon: data.icon,
            title: data.title,
            text: data.text,
            showConfirmButton: false,
            timer: 1500
            })
    }

 </script>

@endsection
