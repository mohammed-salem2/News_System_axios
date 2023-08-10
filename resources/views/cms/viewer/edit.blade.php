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
                            <h3 class="card-title">Update Author</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="first_name">First Name </label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $viewers->user->first_name }}"
                                            placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                            placeholder="Enter Last Name" value="{{ $viewers->user->last_name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="email">Email </label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter Email" value="{{ $viewers->email }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label>Country</label>
                                        <select class="form-control" id="country_id" name="country_id">
                                            @foreach ( $countries as $country)
                                            <option @if ($country->id==$viewers->user->country->id)
                                                selected
                                            @endif value="{{ $country->id }}" >{{ $country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>City</label>
                                        <select class="form-control" id="city_id" name="city_id">
                                            @foreach ($cities as $city )
                                            <option @if ($city->id==$viewers->user->city->id)
                                                selected
                                            @endif value="{{ $city->id }}">{{ $city->city_name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="adress">Adress </label>
                                        <input type="text" class="form-control" name="adress" id="adress"
                                            placeholder="Enter Adress" value="{{ $viewers->user->adress  }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="mobile">Mobile </label>
                                        <input type="number" class="form-control" name="mobile" id="mobile"
                                            placeholder="Enter Mobile" value="{{ $viewers->user->mobile  }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label>Status</label>
                                        <select class="form-control" id="status" name="status">
                                            {{-- <option selected>{{ $authors->user->status }}</option> --}}
                                            <option @if ($viewers->user->status == 'active')
                                                selected
                                            @endif  value="active">Active</option>
                                            <option @if ($viewers->user->status == 'non-active')
                                                selected
                                            @endif value="non-active">Non-active</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            {{-- <option selected>{{ $admins->user->gender }}</option> --}}
                                            <option @if ($viewers->user->gender == 'male')
                                                selected
                                            @endif value="male">Male</option>
                                            <option  @if ($viewers->user->gender == 'female')
                                                selected
                                            @endif value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>birth</label>
                                        <input type="date" class="form-control" name="birth" id="birth" value="{{ $viewers->user->birth }}">
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Choose your image</label>
                                        <input type="file" class="form-control" name="image" id="image"
                                            >
                                    </div>
                                    {{-- <div class="form-group col-12 col-md-6">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image" id="image"
                                            placeholder="Enter Mobile">
                                    </div> --}}
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="performUpdate({{ $viewers->id }})" type="button" class="btn btn-primary">Update</button>
                                <a href="{{ route('viewers.index') }}" type="submit" class="btn btn-info">Go Back</a>
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
            let data = ['first_name','last_name','email' ,'adress',
            'mobile','status','gender','birth','country_id' , 'city_id'];
            for (let i = 0; i < data.length; i++) {
                formData.append(data[i], document.getElementById(data[i]).value);
            }
            formData.append('image', document.getElementById('image').files[0]);
        storeRoute('/cms/admin/viewers-update/'+id , formData);
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
