<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;

class SlidesController extends Controller
{
                /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::latest()->paginate(10);
        return response()->json($slides);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'tagline' => 'required|string'
        ]);

        $user = auth('api')->user();
        
        if($request->photo){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);
            
            $slides = Slide::create([
                'title' => $request['title'],
                'photo' => $request['photo'],
                'tagline' => $request['tagline']
            ]);

        return response()->json($slides);
        }else{
            $slides = Slide::create([
                'title' => $request['title'],
                'photo' => $request['photo'],
                'tagline' => $request['tagline']
            ]);
            
        return response()->json($slides);        
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'tagline' => 'required|string'
        ]);

        $currentImage = $slide->photo;

        if($request->photo != $currentImage){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);

         //delete old photo from server
        $slideImage = public_path('uploads/').$currentImage;
        if(file_exists($slideImage)){
            @unlink($slideImage);
        } 
        $slide->update($request->all());   
        }else{
        $slide->update($request->all());    
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
        // $this->authorize('isAdmin');
        $slide = Slide::findOrFail($id);

        //delete slide
        $slide->delete();
        return (['message' => 'Slide deleted']);
    }      
}
