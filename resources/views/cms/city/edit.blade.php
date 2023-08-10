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
                            <h3 class="card-title">Add New City</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 col-md-4">
                                        <label>Country</label>
                                        <select class="form-control" id="country_id" name="country_id">
                                            @foreach ( $countries as $country)
                                            <option @if ($country->id==$cities->country_id)
                                                selected
                                            @endif value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-4">
                                        <label for="city_name">Name of the City </label>
                                        <input type="text" class="form-control" name="city_name" id="city_name"
                                            placeholder="Enter Name of the country" value="{{ $cities->city_name }}">
                                    </div>
                                    <div class="form-group col-12 col-md-4">
                                        <label for="street">Street</label>
                                        <input type="text" class="form-control" name="street" id="street"
                                            placeholder="Enter country code" value="{{ $cities->street }}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="performUpdate({{ $cities->id }})" type="button" class="btn btn-primary">Update</button>
                                <a href="{{ route('cities.index') }}" type="submit" class="btn btn-info">Go Back</a>
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
            formData.append('city_name', document.getElementById('city_name').value);
            formData.append('street', document.getElementById('street').value);
            formData.append('country_id', document.getElementById('country_id').value);
        storeRoute('/cms/admin/cities-update/'+id , formData);
        // الشرطو الاولنية ضرورية في المسار ي كود js
    }
</script>
@endsection
