@extends('cms.parent')

@section('title', 'Index City')

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
                            <a href="{{ route('cities.create') }}" type="submit" class="btn btn-info">Create New City</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>City Name</th>
                                        <th>Street</th>
                                        <th>Country Name</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td>{{ $city->id }}</td>
                                            <td>{{ $city->city_name }}</td>
                                            <td>
                                                {{ $city->street }}
                                            </td>
                                            <td>
                                                {{ $city->country->name }}
                                            </td>
                                            <td>
                                                <div class="btn">
                                                    <a href="{{ route('cities.edit' , $city->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="performDestory({{ $city->id  }} , this)" type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $cities->links() }}
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
        confirmDestroy('/cms/admin/cities/' +id , referenace);
    }
</script>
@endsection
