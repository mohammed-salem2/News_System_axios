<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::with('user')->orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.admin.index' , compact('admins'));
    }
    public function index_delete()
    {
        $admins = Admin::with('user')->onlyTrashed()->orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.admin.delete' , compact('admins'));
    }
    public function restore($id){
        $admins = Admin::with('user')->onlyTrashed()->findOrFail($id)->restore();
        return back();
    }
    public function force_delete($id){
        $admins = Admin::with('user')->onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
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
        $roles = Role::where('guard_name' , '=' , 'admin')->get();
        return response()->view('cms.admin.create',compact('countries' , 'cities' , 'roles' ));
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
            'email' => 'required|min:3|max:30|unique:admins' ,
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
            $admins= new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if($isSaved){
                $users = new User();
                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                if(request()->hasFile('image')){
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/admin' , $imageName);
                    $users->image = $imageName;
                }
                $roles = Role::findOrFail($request->get('role_id'));
                $admins->assignRole($roles->name);
                $users->country_id = $request->get('country_id');
                $users->adress = $request->get('adress');
                $users->mobile = $request->get('mobile');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->birth = $request->get('birth');
                $users->city_id = $request->get('city_id');
                $users->actor()->associate($admins);
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
        $admins = Admin::findOrFail($id);
        return response()->view('cms.admin.edit' , compact('admins' , 'countries' , 'cities'));
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
            'email' => 'required|min:3|max:30|unique:admins,email,'.$id ,
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
            $admins= Admin::findOrFail($id);
            $admins->email = $request->get('email');
            $isUpdated = $admins->save();
            if($isUpdated){
                $users = $admins->user;
                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                if(request()->hasFile('image')){
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/admin' , $imageName);
                    $users->image = $imageName;
                }
                $users->country_id = $request->get('country_id');
                $users->adress = $request->get('adress');
                $users->mobile = $request->get('mobile');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->birth = $request->get('birth');
                $users->city_id = $request->get('city_id');
                $users->actor()->associate($admins);
                $isUpdated = $users->save();
                return['redirect' =>route('admins.index')];
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
        $admins= Admin::destroy($id);
        return response()->json([
            'icon' => 'success' , 'title'=>'Deleted is Successfuly'
        ] );
    }
}
