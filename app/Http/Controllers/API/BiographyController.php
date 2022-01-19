<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biography;

class BiographyController extends Controller
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
        return Biography::latest()->paginate(5);
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
            'details' => 'required|string|max:255'
        ]);

        if($request->photo){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('images/').$name);
            $request->merge(['photo' => $name]);
            
        return Biography::create([
                'details' => $request['details'],
                'photo' => $request['photo'],
            ]);
        }else{
        return Biography::create([
                'title' => $request['title'],
                'details' => $request['details'],
                'photo' => $request['photo'],
            ]);    
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
        $biography = Biography::findOrFail($id);
        $this->validate($request,[
            'details' => 'required|string|max:255'
        ]);

        $currentPhoto = $biography->photo;

        if($request->photo != $currentPhoto){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('images/').$name);
            $request->merge(['photo' => $name]);

         //delete old photo from server
        $biographyPhoto = public_path('images/').$currentPhoto;
        if(file_exists($biographyPhoto)){
            @unlink($biographyPhoto);
        } 
        $biography->update($request->all());   
        }else{
        $biography->update($request->all());    
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
        $this->authorize('isAdmin');
        $biography = Biography::findOrFail($id);

        //delete biography
        $biography->delete();
    }    
}
