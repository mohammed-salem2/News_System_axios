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
                            <h3 class="card-title">Add New Author</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="first_name">First Name </label>
                                        <input type="text" class="form-control" name="first_name" id="first_name"
                                            placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                            placeholder="Enter Last Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="email">Email </label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="password">Password </label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Enter password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label>Country</label>
                                        <select class="form-control" id="country_id" name="country_id">
                                            @foreach ( $countries as $country)
                                            <option value="{{ $country->id }}" >{{ $country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>City</label>
                                        <select class="form-control" id="city_id" name="city_id">
                                            <option value="" >Select city</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="adress">Adress </label>
                                        <input type="text" class="form-control" name="adress" id="adress"
                                            placeholder="Enter Adress">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="mobile">Mobile </label>
                                        <input type="number" class="form-control" name="mobile" id="mobile"
                                            placeholder="Enter Mobile">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label>Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Choose Status</option>
                                            <option value="active">Active</option>
                                            <option value="non-active">Non-active</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="">Choose Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>birth</label>
                                        <input type="date" class="form-control" name="birth" id="birth"
                                            placeholder="Enter Mobile">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image" id="image"
                                        >
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="role_id">Roles</label>
                                        <select class="form-control" id="role_id" name="role_id">
                                            @foreach ( $roles as $role)
                                            <option value="{{ $role->id }}" >{{ $role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="performStore()" type="button" class="btn btn-primary">Store</button>
                                <a href="{{ route('admins.index') }}" type="submit" class="btn btn-info">Go Back</a>
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
            let data = ['first_name','last_name','email','password','adress',
            'mobile','status','gender','birth','country_id' , 'city_id' , 'role_id'];
            for (let i = 0; i < data.length; i++) {
                formData.append(data[i], document.getElementById(data[i]).value);
            }
            formData.append('image', document.getElementById('image').files[0]);
            store('/cms/admin/admins', formData);
            // الشرطو الاولنية ضرورية في المسار ي كود js
        }
    </script>

<script type="text/javascript">
    $('#country_id').on('change', function() {
            get_city_by_country();
        });
            function get_city_by_country(){
                let country_id = $('#country_id').val();
                $.post('{{route('getCities')}}',{_token:'{{ csrf_token() }}', country_id:country_id}, function(data){
                    $('#city_id').html(null);
                    for (var i = 0; i < data.length; i++) {
                        $('#city_id').append($('<option>', {
                            value: data[i].id,
                            text: data[i].city_name
                        }));
                    }
            });
        }
</script>


@endsection
