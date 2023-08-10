@extends('cms.parent')

@section('title', 'Index Permission')

@section('pageTitle', 'Index Permission')

@section('activeTitle', 'Index Permission')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('permissions.create') }}" type="submit" class="btn btn-info">Create New Permission</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Permission Name</th>
                                        <th>Guard_name</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                {{ $permission->guard_name }}
                                            </td>
                                            <td>
                                                <div class="btn">
                                                    <a href="{{ route('permissions.edit' , $permission->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="performDestory({{ $permission->id  }} , this)" type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $permissions->links() }}
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
        confirmDestroy('/cms/admin/permissions/' +id , referenace);
    }
</script>
@endsection
