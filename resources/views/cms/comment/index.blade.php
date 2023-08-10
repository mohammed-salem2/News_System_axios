@extends('cms.parent')

@section('title', 'Index Comment')

@section('pageTitle', 'Index Comment')

@section('activeTitle', 'Index Comment')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <a href="{{ route('cities.create') }}" type="submit" class="btn btn-info">Create New Comment
                        </a>
                        </div> --}}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Commentr Name</th>
                                        <th>Comment Name</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>{{ $comment->id }}</td>
                                            {{-- <td>{{ $Comment->viewer->user->first_name ?? "" }}</td> --}}
                                            <td>
                                                {{ $Comment->comment }}
                                            </td>
                                            <td>
                                                <div class="btn">
                                                    <button onclick="performDestory({{ $comment->id  }} , this)" type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $comments->links() }}
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
        confirmDestroy('/cms/admin/comments/' +id , referenace);
    }
</script>
@endsection
