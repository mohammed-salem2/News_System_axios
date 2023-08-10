@extends('cms.parent')

@section('title', 'Index Slider')

@section('pageTitle', 'Index Slider')

@section('activeTitle', 'Index Slider')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="" method="get" style="margin-bottom:2%">
                                <div class="row">
                                    <div class="input-icon col-md-4">
                                        <input type="text" class="form-control" placeholder="Search By Title" name="title"
                                        @if (request()->title)
                                        vlaue={{ request()->title }}
                                        @endif >
                                        <span>
                                            <i class="flaticon2-search1 text-muted"></i>
                                        </span>
                                    </div>
                                    <div class="input-icon col-md-4">
                                        <input type="text" class="form-control" placeholder="Search By Description" name="description"
                                        @if (request()->description)
                                        vlaue={{ request()->description }}
                                        @endif >
                                        <span>
                                            <i class="flaticon2-search1 text-muted"></i>
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-success btn-md" type="submit">Fliter</button>
                                        <a href="{{ route('sliders.index') }}" class="btn btn-danger">Finish Fliter</a>
                                        <a href="{{ route('sliders.create') }}" type="submit" class="btn btn-info">Create New Sliders</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Slider title</th>
                                        <th>description</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $slider->id }}</td>
                                            <td>{{ $slider->title }}</td>
                                            <td>
                                                {{ $slider->description }}
                                            </td>
                                            <td>
                                                <div class="btn">
                                                    <a href="{{ route('sliders.edit' , $slider->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="performDestory({{ $slider->id  }} , this)" type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('sliders.show' , $slider->id) }}" class="btn btn-success">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $sliders->links() }}
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
        confirmDestroy('/cms/admin/sliders/' +id , referenace);
    }
</script>
@endsection
