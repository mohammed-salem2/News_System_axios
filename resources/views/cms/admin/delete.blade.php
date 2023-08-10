@extends('cms.parent')

@section('title', 'Index ')

@section('pageTitle', 'Index City')

@section('activeTitle', 'Index City')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admins.index') }}" type="submit" class="btn btn-info">Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Gender</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->user->first_name . " " . $admin->user->last_name ?? ""}}</td>
                                            <td>
                                                {{ $admin->email }}
                                            </td>
                                            <td>
                                                {{ $admin->user->status ?? "" }}
                                            </td>
                                            <td>
                                                {{ $admin->user->gender ?? "" }}
                                            </td>
                                            <td>
                                                {{ $admin->user->country->name ?? "" }}
                                            </td>
                                            <td>
                                                {{ $admin->user->city->city_name ?? "" }}
                                            </td>
                                            <td>
                                                <div class="btn">
                                                    <a href="{{ route('admin.restore' , $admin->id) }}" class="btn btn-info">
                                                        <i class="fas fa-trash-restore"></i>
                                                    </a>
                                                    <a href="{{ route('admin.delete', $admin->id) }}" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $admins->links() }}
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
        confirmDestroy('/cms/admin/admins/' +id , referenace);
    }
</script>
@endsection
