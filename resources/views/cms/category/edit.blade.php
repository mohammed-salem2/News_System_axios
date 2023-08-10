@extends('cms.parent')

@section('title', 'Edit')

@section('pageTitle', 'Edit')

@section('activeTitle', 'Edit')

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
                        <h3 class="card-title">Update Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name of the Category </label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter Name of the country" value="{{ $categories->name }}">
                            </div>
                            <div class="form-group col-12">
                                <label>Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Choose Status</option>
                                    <option @if ($categories->status == 'active')
                                        selected
                                    @endif value="active">Active</option>
                                    <option @if ($categories->status == 'on-active')
                                        selected
                                    @endif value="on-active">Non-active</option>
                                </select>
                            </div>
                            <div class="form-body">
                                <label for="description">
                                    Description of Category
                                </label>
                                <textarea class="form-control" style="resize: none;" id="description" name="description" placeholder="Enter description" cols="50">{{ $categories->description }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button onclick="performUpdate({{ $categories->id }})" type="button" class="btn btn-primary">Store</button>
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
    function performUpdate(id){
        let formData = new FormData();
            let data = ['name' , 'description' , 'status'];
            for (let i = 0; i < data.length; i++) {
                formData.append(data[i], document.getElementById(data[i]).value);
            }
        storeRoute('/cms/admin/categories-update/'+id , formData);
        // الشرطو الاولنية ضرورية في المسار ي كود js
    }
</script>
@endsection
