<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\Viewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ViewerController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewers = Viewer::with('user')->orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.viewer.index' , compact('viewers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries= Country::with('cities')->orderBy('name')->get();
        $cities = City::with('country')->orderBy('city_name')->get();
        return response()->view('cms.viewer.create',compact('countries' , 'cities'));
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
            'first_name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20',
            'last_name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20',
            'email' => 'required|min:3|max:30|unique:authors' ,
            'password' => 'required|min:3|max:30' ,
            'country_id' => 'required' ,
            'adress' => 'required|min:3|max:50' ,
            'mobile'=> 'required' ,
            'status' => 'required' ,
            'gender' => 'required' ,
            'birth' => 'required' ,
            'city_id' => 'required' ,
            'image' => 'required | image | max:2048 | mimes:png,jpg,jpeg,pdf' ,
        ]);
        if(! $validator->fails()){
            $viewers= new Viewer();
            $viewers->email = $request->get('email');
            $viewers->password = Hash::make($request->get('password'));
            $isSaved = $viewers->save();
            if($isSaved){
                $users = new User();

                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('storage/images/viewer' , $imageName);
                $users->image = $imageName;

                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                $users->country_id = $request->get('country_id');
                $users->adress = $request->get('adress');
                $users->mobile = $request->get('mobile');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->birth = $request->get('birth');
                $users->city_id = $request->get('city_id');
                $users->actor()->associate($viewers);
                $isSaved = $users->save();
                if($isSaved){
                return response()->json(['icon'=>'success' , 'title'=>"Created is done"] , 200);
                }
                else{
                    return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
                }
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
        $countries= Country::with('cities')->orderBy('name')->get();
        $cities = City::with('country')->orderBy('city_name')->get();
        $viewers = Viewer::findOrFail($id);
        return response()->view('cms.viewer.edit' , compact('viewers' , 'countries' , 'cities'));
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
            'first_name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20',
            'last_name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20',
            'email' => 'required|min:3|max:30|unique:authors,email,'.$id ,
            'country_id' => 'required' ,
            'adress' => 'required|min:3|max:50' ,
            'mobile'=> 'required' ,
            'status' => 'required' ,
            'gender' => 'required' ,
            'birth' => 'required' ,
            'city_id' => 'required' ,

        ]);
        if(! $validator->fails()){
            $viewers= Viewer::findOrFail($id);
            $viewers->email = $request->get('email');
            $isUpdated = $viewers->save();
            if($isUpdated){
                $users = $viewers->user;

                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('storage/images/viewer' , $imageName);
                $users->image = $imageName;

                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                $users->country_id = $request->get('country_id');
                $users->adress = $request->get('adress');
                $users->mobile = $request->get('mobile');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->birth = $request->get('birth');
                $users->city_id = $request->get('city_id');
                $users->actor()->associate($viewers);
                $isUpdated = $users->save();
                return['redirect' =>route('viewers.index')];
                if($isUpdated){
                return response()->json(['icon'=>'success' , 'title'=>"Created is done"] , 200);
                }
                else{
                    return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
                }
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
        $viewers= Viewer::destroy($id);
        return response()->json([
            'icon' => 'success' , 'title'=>'Deleted is Successfuly'
        ] );
    }
}
