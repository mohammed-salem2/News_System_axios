<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Dotenv\Validator;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries= Country::with('cities')->orderBy('id' , "desc")->paginate(10);
        // من اجل ترتيب البيانات تنازلي من الاحدث الى الاقدم

        return response()->view('cms.country.index' , compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.country.create');
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
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20|unique:countries',
            'code' => 'required|numeric|digits_between:1,3|unique:countries',
        ]);
        if(! $validator->fails()){
            $countries= new Country();
            $countries->name = $request->get('name');
            $countries->code = $request->get('code');
            $isSaved = $countries->save();
            if($isSaved){
                return response()->json(['icon'=>'success' , 'title'=>"Created is done"] , 200);
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
        $countries= Country::findOrFail($id);
        return response()->view('cms.country.edit' , compact('countries'));
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
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20|unique:countries,name,'.$id,
            'code' => 'required|numeric|digits_between:1,3|unique:countries,code,'.$id,
        ],
);
        if(! $validator->fails()){
            $countries= Country::findOrFail($id);
            $countries->name = $request->get('name');
            $countries->code = $request->get('code');
            $isUpdate = $countries->save();
            return['redirect' =>route('countries.index')];
            if($isUpdate){
                return response()->json(['icon'=>'success' , 'title'=>"Updated is done"] , 200);
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
        $countries = Country::destroy($id);
        return response()->json([
            'icon' => 'success' , 'title'=>'Deleted is Successfuly'
        ] , 200);
    }
}
