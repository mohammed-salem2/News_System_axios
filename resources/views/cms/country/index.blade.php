@extends('cms.parent')

@section('title', 'Index Country')

@section('pageTitle', 'Index Country')

@section('activeTitle', 'Index Country')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('countries.create') }}" type="submit" class="btn btn-info">Create New Country</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width">Name of cities</th>
                                        <th>Country Name</th>
                                        <th>Country Code</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $country)
                                        <tr>
                                            <td>{{ $country->id }}</td>
                                            <td>
                                                @foreach ($country->cities as $city ){
                                                    {{  $city->city_name; }}
                                                }
                                                @endforeach
                                            </td>
                                            <td>{{ $country->name }}</td>
                                            <td>
                                                {{ $country->code }}
                                            </td>
                                            <td>
                                                <div class="btn">
                                                    <a href="{{ route('countries.edit' , $country->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="performDestory({{ $country->id  }} , this)" type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $countries->links() }}
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
        confirmDestroy('/cms/admin/countries/' +id , referenace);
    }
</script>
@endsection
