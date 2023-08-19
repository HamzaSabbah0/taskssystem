@extends('panel.layout.app')

@section('page-title', 'create permission')
@section('big-page-title', 'Create Permission')
@section('main-page-title', 'Home')
@section('small-page-title', 'create permission')

@section('styles')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Permission</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Guard</label>
                    <select class="form-control guards" id="guards" style="width: 100%;">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name">
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" onclick="store()" class="btn btn-primary">Store</button>
                </div>
        </form>
    </div>
@endsection

@section('scripts')

    <!-- Select2 -->
    <script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        // $('.guards').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        function store() {
            axios.post('/panel/premissions', {
                    name: document.getElementById('name').value,
                    guard_name: document.getElementById('guards').value,
                })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = "/panel/premissions";
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    toastr.error(error.response.data.message);
                })
        }
    </script>

@endsection
