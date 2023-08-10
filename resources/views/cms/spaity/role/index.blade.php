@extends('cms.parent')

@section('title', 'Index Role')

@section('pageTitle', 'Index Role')

@section('activeTitle', 'Index Role')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('roles.create') }}" type="submit" class="btn btn-info">Create New Role</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Role Name</th>
                                        <th>Guard_name</th>
                                        <th>Permissions</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                {{ $role->guard_name }}
                                            </td>
                                            <td><a href="{{route('roles.permissions.index', $role->id)}}"
                                                class="btn btn-info">({{$role->permissions_count}})
                                                permissions/s</a> </td>
                                            <td>
                                                <div class="btn">
                                                    <a href="{{ route('roles.edit' , $role->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="performDestory({{ $role->id  }} , this)" type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $roles->links() }}
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('jsFile')
<script>
    function performDestory(id , referenace){
        confirmDestroy('/cms/admin/roles/' +id , referenace);
    }
</script>
@endsection
