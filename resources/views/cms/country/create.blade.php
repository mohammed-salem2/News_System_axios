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
                            <h3 class="card-title">Add New Country</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name of the country </label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Name of the country">
                                </div>
                                <div class="form-group">
                                    <label for="code">Country Code</label>
                                    <input type="text" class="form-control" name="code" id="code"
                                        placeholder="Enter country code">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button onclick="performStore()" type="button" class="btn btn-primary">Store</button>
                                <a href="{{ route('countries.index') }}" type="submit" class="btn btn-info">Go Back</a>
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
        formData.append('name' , document.getElementById('name').value);
        formData.append('code' , document.getElementById('code').value);
        store('/cms/admin/countries' , formData);
        // الشرطو الاولنية ضرورية في المسار ي كود js
    }
</script>

@endsection
