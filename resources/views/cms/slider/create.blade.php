@extends('cms.parent')

@section('title', 'Create')

@section('pageTitle', 'Create')

@section('activeTitle', 'Create')

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
                            <h3 class="card-title">Add New Slider</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="city_form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="title">Title </label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter Title">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="description">Description</label>
                                        <textarea  class="form-control" style="resize: none;" cols="60" name="description" id="description"
                                            placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="image">Chooser Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="performStore()" type="button" class="btn btn-primary">Store</button>
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
        function performStore() {
            let formData = new FormData();
            let data = ['title', 'description'];
            for (let i = 0; i < data.length; i++) {
                formData.append(data[i], document.getElementById(data[i]).value);
            }
            formData.append('image', document.getElementById('image').files[0]);
            store('/cms/admin/sliders', formData);
            // الشرطو الاولنية ضرورية في المسار ي كود js
        }
    </script>

@endsection
