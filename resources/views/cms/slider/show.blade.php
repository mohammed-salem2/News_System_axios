@extends('cms.parent')

@section('title', 'Show')

@section('pageTitle', 'Show')

@section('activeTitle', 'Show')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Show Slider</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="city_form">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group col-md-6">
                                        <img class="img-circle img-bordered-sm" src="{{asset('storage/images/slider/'.$sliders->image)}}" width="200" height="200">
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="title">Title </label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter Title" value="{{ $sliders->title }}" disabled>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="description">Description</label>
                                        <textarea  class="form-control" style="resize: none;" cols="60" name="description" id="description"
                                            placeholder="Enter description" disabled>{{ $sliders->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('sliders.index') }}" type="submit" class="btn btn-info">Go Back</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('jsFile')
<script>
    function performUpdate(id){
        let formData = new FormData();
        let data = ['title', 'description'];
            for (let i = 0; i < data.length; i++) {
                formData.append(data[i], document.getElementById(data[i]).value);
            }
            formData.append('image', document.getElementById('image').files[0]);
        storeRoute('/cms/admin/sliders-update/'+id , formData);
        // الشرطو الاولنية ضرورية في المسار ي كود js
    }
</script>
@endsection
