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
                            <h3 class="card-title">Add New Permission</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="city_form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label>Guard Name</label>
                                        <select class="form-control" id="guard_name" name="guard_name" style="width: 100%;" aria-label=".form-select-sm example">
                                            <option value="admin" >Admin</option>
                                            <option value="author" >Author</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="name">Permission Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Name of the Permission">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="performStore()" type="button" class="btn btn-primary">Store</button>
                                <a href="{{ route('permissions.index') }}" type="submit" class="btn btn-info">Go Back</a>
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
            let data = ['name', 'guard_name'];
            for (let i = 0; i < data.length; i++) {
                formData.append(data[i], document.getElementById(data[i]).value);
            }
            store('/cms/admin/permissions', formData);
            // الشرطو الاولنية ضرورية في المسار ي كود js
        }
    </script>

@endsection
