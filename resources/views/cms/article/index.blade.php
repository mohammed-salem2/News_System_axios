@extends('cms.parent')

@section('title', 'Index Article')

@section('pageTitle', 'Index Article')

@section('activeTitle', 'Index Article')

@section('cssFile')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('createArticle' , $id) }}" type="submit" class="btn btn-info">Create New Article</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Article Title</th>
                                        <th>Article Short-Description </th>
                                        <th>Article Full-Description</th>
                                        <th>Author</th>
                                        <th>Catogery</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td>{{ $article->id }}</td>
                                            <td>{{ $article->title }}</td>
                                            <td>
                                                {{ $article->short_desc }}
                                            </td>
                                            <td>
                                                {{ $article->full_desc }}
                                            </td>
                                            <td>
                                                {{ $article->author_id }}
                                            </td>
                                            <td>
                                                {{ $article->category_id }}
                                            </td>
                                            <td>
                                                <div class="btn">
                                                    <a href="{{ route('articles.edit' , $article->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="performDestory({{ $article->id  }} , this)" type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('articles.show' , $article->id) }}" class="btn btn-success">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $articles->links() }}
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
        confirmDestroy('/cms/admin/articles/' +id , referenace);
    }
</script>
@endsection
