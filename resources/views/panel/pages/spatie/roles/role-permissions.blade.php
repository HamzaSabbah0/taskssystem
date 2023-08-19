@extends('panel.layout.app')

@section('page-title', 'role permissions')
@section('big-page-title', 'Role Permissions Information')
@section('main-page-title', 'Home')
@section('small-page-title', 'Role Permissions')

@section('styles')

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $role->name }} Permissions</h3>

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
                                <th>Name</th>
                                <th>Guard</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td><span class="badge bg-success">{{ $permission->guard_name }}</span></td>
                                    <td>
                                        <div class="icheck-primary d-inline">
                                            <input onchange="assignPermission({{ $role->id }} , {{ $permission->id }})"
                                                type="checkbox" id="permission_{{ $permission->id }}"
                                                @if ($permission->assigned) checked @endif>
                                            <label for="permission_{{ $permission->id }}">
                                            </label>
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
        function assignPermission(roleId, permissionId) {
            axios.post('/panel/role/' + roleId + '/permissions', {
                    permission_id: permissionId
                })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    toastr.error(error.response.data.message);
                })
        }
    </script>

    {{-- <script>
        function assignPermission(roleId, permissionId) {
            axios.post('/cms/admin/permissions/role', {
                    role_id: roleId,
                    permission_id: permissionId
                }).then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });
        }
    </script> --}}

@endsection
