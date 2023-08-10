<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexArticle($id)
    {
        $articles = Article::where('author_id', $id)->orderBy('id', 'desc')->paginate(5);
        return response()->view('cms.article.index', compact('articles','id'));
    }

    public function index()
    {
        $articles = Article::with('author' , 'category')->orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.article.index' , compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createArticle($id)
    {
        $authors = Author::with('user')->get();
        $categories = Category::where('status' , '=' , 'active')->get();
        return response()->view('cms.article.create', compact('authors' , 'categories', 'id'));
    }

    public function create()
    {
        $authors = Author::with('user')->get();
        $categories = Category::where('status' , '=' , 'active')->get();
        return response()->view('cms.article.create' , compact('authors' , 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
$roles = [
    'title' => 'required',
    'short_desc' => 'required',
    'full_desc' => 'required' ,
    'author_id' => 'required' ,
    'category_id' => 'required' ,
    'image' => 'required | image | max:2048 | mimes:png,jpg,jpeg,pdf' ,
];
        $validator = Validator($request->all() , $roles );
        if(! $validator->fails()){
            $articles = new Article();
            $articles->title = $request->get('title');
            if(request()->hasFile('image')){
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('storage/images/article' , $imageName);
                $articles->image = $imageName;
            }
            $articles->short_desc = $request->get('short_desc');
            $articles->full_desc = $request->get('full_desc');
            $articles->author_id = $request->get('author_id');
            $articles->category_id = $request->get('category_id');
            $isSaved= $articles->save();
            if($isSaved){
                return response()->json(['icon'=>'success' , 'title'=>"Created is done"] , 200);
            }
            else{
                return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
            }
        }
        else{
            return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $authors = Author::with('user')->get();
        $categories = Category::where('status' , '=' , 'active')->get();
        $articles = Article::findOrFail($id);
        return response()->view('cms.article.show' , compact('authors' , 'categories' , 'articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Author::with('user')->get();
        $categories = Category::where('status' , '=' , 'active')->get();
        $articles = Article::findOrFail($id);
        return response()->view('cms.article.edit' , compact('authors' , 'categories' , 'articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roles = [
            'title' => 'required',
            'short_desc' => 'required',
            'full_desc' => 'required' ,
            'category_id' => 'required' ,
            'image' => 'required | image | max:2048 | mimes:png,jpg,jpeg,pdf' ,
        ];
                $validator = Validator($request->all() , $roles );
                if(! $validator->fails()){
                    $articles = Article::findOrFail($id);
                    $articles->title = $request->get('title');
                    if(request()->hasFile('image')){
                        $image = $request->file('image');
                        $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                        $image->move('storage/images/article' , $imageName);
                        $articles->image = $imageName;
                    }
                    $articles->short_desc = $request->get('short_desc');
                    $articles->full_desc = $request->get('full_desc');
                    // $articles->author_id = $request->get('author_id');
                    $articles->category_id = $request->get('category_id');
                    $isUpdated= $articles->save();
                    return['redirect' =>route('indexArticle',['id'=> $articles->author->id])];
                    if($isUpdated){
                        return response()->json(['icon'=>'success' , 'title'=>"Created is done"] , 200);
                    }
                    else{
                        return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
                    }
                }
                else{
                    return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articles = Article::destroy($id);
        return response()->json([
            'icon' => 'success' , 'title'=>'Deleted is Successfuly'
        ] );
    }
}
