@extends('cms.parent')

@section('title', 'Index Author ')

@section('pageTitle', 'Index Author')

@section('activeTitle', 'Index Author')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('authors.create') }}" type="submit" class="btn btn-info">Create New Author</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Full Name</th>
                                        {{-- <th>Image</th> --}}
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Gender</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Article</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($authors as $author)
                                        <tr>
                                            <td>{{ $author->id }}</td>
                                            <td>{{ $author->user->first_name . " " . $author->user->last_name ?? ""}}</td>
                                            {{-- <td>
                                                <img class="img-circle img-bordered-sm" src="{{ asset( 'storage/images/author/' .$author->user->image
                                                ) }}"
                                            </td>--}}
                                            <td>
                                                {{ $author->email }}
                                            </td>
                                            <td>
                                                {{ $author->user->status ?? "" }}
                                            </td>
                                            <td>
                                                {{ $author->user->gender ?? "" }}
                                            </td>
                                            <td>
                                                {{ $author->user->country->name ?? "" }}
                                            </td>
                                            <td>
                                                {{ $author->user->city->city_name ?? "" }}
                                            </td>
                                            <td><a href="{{route('indexArticle',['id'=>$author->id])}}"
                                                class="btn btn-info">({{$author->articles_count}})
                                                article/s</a> </td>
                                            <td>
                                                <div class="btn">
                                                    <a href="{{ route('authors.edit' , $author->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="performDestory({{ $author->id  }} , this)" type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $authors->links() }}
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
        confirmDestroy('/cms/admin/authors/' +id , referenace);
    }
</script>
@endsection
