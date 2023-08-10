<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::withCount('permissions')->orderBy('id','desc')->paginate(10);
        return response()->view('cms.spaity.role.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create' , Admin::class);
        return response()->view('cms.spaity.role.create');
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
            'name' => 'required|string|min:3|max:20',
            'guard_name' => 'required',
        ]);
        if(! $validator->fails()){
            $roles= new Role();
            $roles->name = $request->get('name');
            $roles->guard_name = $request->get('guard_name');
            $isSaved = $roles->save();
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
        $roles = Role::findOrFail($id);
        return response()->view('cms.spaity.role.edit' , compact('roles'));
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
            'name' => 'required|string|min:3|max:20',
            'guard_name' => 'required',
        ]);
        if(! $validator->fails()){
            $roles= Role::findOrFail($id);
            $roles->name = $request->get('name');
            $roles->guard_name = $request->get('guard_name');
            $isUpdated = $roles->save();
            return['redirect' =>route('roles.index')];
            if($isUpdated){
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
        $roles=Role::destroy($id);
        return response()->json([
            'icon' => 'success' , 'title'=>'Deleted is Successfuly'
        ] );
    }
}
