<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
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
        $photos = Photo::latest()->paginate(10);
        return response()->json($photos);
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
            'category' => 'required|string|max:191',
            'description' => 'sometimes|string'
        ]);

        $user = auth('api')->user();
        
        if($request->photo){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);
            
            $photos = Photo::create([
                'category' => $request['category'],
                'photo' => $request['photo'],
                'description' => $request['description']
            ]);

        return response()->json($photos);
        }else{
            $photos = Photo::create([
                'category' => $request['category'],
                'photo' => $request['photo'],
                'description' => $request['description']
            ]);
            
        return response()->json($photos);        
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
        $photo = Photo::findOrFail($id);

        $this->validate($request,[
            'category' => 'required|string|max:191',
            'description' => 'sometimes|string'
        ]);

        $currentImage = $photo->photo;

        if($request->photo != $currentImage){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);

         //delete old photo from server
        $photoImage = public_path('uploads/').$currentImage;
        if(file_exists($photoImage)){
            @unlink($photoImage);
        } 
        $photo->update($request->all());   
        }else{
        $photo->update($request->all());    
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
        $photo = Photo::findOrFail($id);

        //delete photo
        $photo->delete();
        return (['message' => 'Photo deleted']);
    }      
}
