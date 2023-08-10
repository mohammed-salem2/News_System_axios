@extends('cms.parent')

@section('title', 'Show')

@section('pageTitle', 'Show')

@section('activeTitle', 'Show')

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
                            <h3 class="card-title">Add New Article</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group col-md-6">
                                    <img class="img-circle img-bordered-sm" src="{{asset('storage/images/article/'.$articles->image)}}" width="200" height="200">
                            </div>
                                <div class="form-group">
                                    <label for="title">Title of the Article </label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="Enter title of the Article" value="{{ $articles->title }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="short_desc">
                                        Short-Description of Article
                                    </label>
                                    <textarea class="form-control" style="resize: none;" id="short_desc" name="short_desc" placeholder="Enter Short_Description" cols="60" disabled>{{ $articles->short_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="full_desc">
                                        Full-Description of Article
                                    </label>
                                    <textarea class="form-control" style="resize: none;" id="full_desc" name="full_desc" placeholder="Enter Full_Description" cols="60" disabled>{{$articles->full_desc}}</textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label>Author</label>
                                        <select class="form-control" id="author_id" name="author_id" disabled>
                                            @foreach ( $authors as $author)
                                            <option @if ($author->id==$articles->author_id)
                                                selected
                                            @endif value="{{ $author->id }}">{{ $author->user->first_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>Category</label>
                                        <select class="form-control" id="category_id" name="category_id" disabled>
                                            @foreach ( $categories as $category)
                                            <option @if ($category->id==$articles->category_id)
                                                selected
                                            @endif  value="{{ $category->id }}" >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('indexArticle',['id'=>$articles->author->id])}}" type="submit" class="btn btn-info">Go Back</a>
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
        let data = ['title' , 'short_desc' , 'full_desc' , 'author_id' , 'category_id'];
            for (let i = 0; i < data.length; i++) {
                formData.append(data[i], document.getElementById(data[i]).value);
            }
            formData.append('image', document.getElementById('image').files[0]);
        storeRoute('/cms/admin/articles-update/'+id , formData);
        // الشرطو الاولنية ضرورية في المسار ي كود js
    }
</script>
@endsection
