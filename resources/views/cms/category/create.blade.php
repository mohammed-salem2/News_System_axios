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
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name of the Category </label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Name of the Category">
                                </div>
                                <div class="form-group col-12">
                                    <label>Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">Choose Status</option>
                                        <option value="active">Active</option>
                                        <option value="on-active">Non-active</option>
                                    </select>
                                </div>
                                <div class="form-body">
                                    <label for="description">
                                        Description of Category
                                    </label>
                                    <textarea class="form-control" style="resize: none;" id="description" name="description" placeholder="Enter description" cols="50"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button onclick="performStore()" type="button" class="btn btn-primary">Store</button>
                                <a href="{{ route('categories.index') }}" type="submit" class="btn btn-info">Go Back</a>
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
    function performStore(){
        let formData = new FormData();
            let data = ['name' , 'description' , 'status'];
            for (let i = 0; i < data.length; i++) {
                formData.append(data[i], document.getElementById(data[i]).value);
            }
        store('/cms/admin/categories' , formData);
        // الشرطو الاولنية ضرورية في المسار ي كود js
    }
</script>

@endsection
