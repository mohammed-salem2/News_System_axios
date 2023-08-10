@extends('cms.parent')

@section('title', 'Index Viewer ')

@section('pageTitle', 'Index Viewer')

@section('activeTitle', 'Index Viewer')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('viewers.create') }}" type="submit" class="btn btn-info">Create New Viewer</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Full Name</th>
                                        {{-- <th>Image</th> --}}
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Gender</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewers as $viewer)
                                        <tr>
                                            <td>{{ $viewer->id }}</td>
                                            <td>{{ $viewer->user->first_name . " " . $viewer->user->last_name ?? ""}}</td>
                                            {{-- <td>
                                                <img class="img-circle img-bordered-sm" src="{{ asset( 'storage/images/Viewer/' .$Viewer->user->image
                                                ) }}"
                                            </td>--}}
                                            <td>
                                                {{ $viewer->email }}
                                            </td>
                                            <td>
                                                {{ $viewer->user->status ?? "" }}
                                            </td>
                                            <td>
                                                {{ $viewer->user->gender ?? "" }}
                                            </td>
                                            <td>
                                                {{ $viewer->user->country->name ?? "" }}
                                            </td>
                                            <td>
                                                {{ $viewer->user->city->city_name ?? "" }}
                                            </td>
                                            <td>
                                                <div class="btn">
                                                    <a href="{{ route('viewers.edit' , $viewer->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="performDestory({{ $viewer->id  }} , this)" type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $viewers->links() }}
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
        confirmDestroy('/cms/admin/viewers/' +id , referenace);
    }
</script>
@endsection
