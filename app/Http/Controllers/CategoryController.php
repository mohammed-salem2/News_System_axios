<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.category.index' , compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all() , [
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20',
            'description' => 'required',
            'status' => 'required' ,
        ]);
        if(! $validator->fails()){
            $categories = new Category();
            $categories->name = $request->get('name');
            $categories->description = $request->get('description');
            $categories->status = $request->get('status');
            $isSaved = $categories->save();
            if($isSaved){
                return response()->json(['icon'=>'success' , 'title'=>"Created is done"] , 200);
            } else{
                return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
            }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return response()->view('cms.category.edit' , compact('categories'));
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
        $validator = Validator($request->all() , [
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20',
            'description' => 'required',
            'status' => 'required' ,
        ]);
        if(! $validator->fails()){
            $categories = Category::findOrFail($id);
            $categories->name = $request->get('name');
            $categories->description = $request->get('description');
            $categories->status = $request->get('status');
            $isUpdated = $categories->save();
            return['redirect' =>route('categories.index')];
            if($isUpdated){
                return response()->json(['icon'=>'success' , 'title'=>"Created is done"] , 200);
            } else{
                return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
            }
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
        $categories = Category::destroy($id);
        return response()->json([
            'icon' => 'success' , 'title'=>'Deleted is Successfuly'
        ] );
    }
}
