<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sliders = Slider::orderBy('id' , 'desc');
        if($request->get('title')){
            $sliders = Slider::where('title' , 'like' , '%' . $request->title . '%');
        }
        if($request->get('description')){
            $sliders = Slider::where('description' , 'like' , '%' . $request->description . '%');
        }
        $sliders = $sliders->paginate(5);
        return response()->view('cms.slider.index' , compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.slider.create');
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
            'title' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20',
            'description' => 'required',
            'image' => 'required | image | max:2048 | mimes:png,jpg,jpeg,pdf' ,
        ]);
        if(! $validator->fails()){
            $sliders = new Slider();
            $sliders->title = $request->get('title');
            $sliders->description = $request->get('description');
            if(request()->hasFile('image')){
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('storage/images/slider' , $imageName);
                $sliders->image = $imageName;
            }
            $isSaved = $sliders->save();
            if($isSaved){
                return response()->json(['icon'=>'success' , 'title'=>"Created is done"] , 200);
            }
            else{
                return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
            }
        } else {
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
        $sliders = Slider::findOrFail($id);
        return response()->view('cms.slider.show' , compact('sliders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sliders = Slider::findOrFail($id);
        return response()->view('cms.slider.edit' , compact('sliders'));
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
            'title' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3|max:20',
            'description' => 'required',
            'image' => 'required | image | max:2048 | mimes:png,jpg,jpeg,pdf' ,
        ]);
        if(! $validator->fails()){
            $sliders = Slider::findOrFail($id);
            $sliders->title = $request->get('title');
            $sliders->description = $request->get('description');
            if(request()->hasFile('image')){
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('storage/images/slider' , $imageName);
                $sliders->image = $imageName;
            }
            $isUpdated = $sliders->save();
            return['redirect' =>route('sliders.index')];
            if($isUpdated){
                return response()->json(['icon'=>'success' , 'title'=>"Created is done"] , 200);
            }
            else{
                return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
            }
        } else {
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
        $sliders = Slider::destroy($id);
        return response()->json([
            'icon' => 'success' , 'title'=>'Deleted is Successfuly'
        ] );
    }
}
