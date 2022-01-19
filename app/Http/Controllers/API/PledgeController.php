<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pledge;

class PledgeController extends Controller
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
        $pledges = Pledge::latest()->paginate(1);
        return response()->json($pledges);
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
            'pledge' => 'required|string|max:191',
            'details' => 'required|string'
        ]);

        $user = auth('api')->user();
        
        if($request->photo){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);
            
            $pledge = Pledge::create([
                'pledge' => $request['pledge'],
                'details' => $request['details'],
                'photo' => $request['photo'],
                'slug' => $request['slug']
            ]);

        return response()->json($pledge);
        }else{
            $pledge = Pledge::create([
                'pledge' => $request['pledge'],
                'details' => $request['details'],
                'photo' => $request['photo'],
                'slug' => $request['slug']
            ]); 
            
        return response()->json($pledge);        
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
        $pledge = Pledge::findOrFail($id);

        $this->validate($request,[
            'pledge' => 'required|string|max:191',
            'details' => 'required|string'
        ]);

        $currentImage = $pledge->photo;

        if($request->photo != $currentImage){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);

         //delete old photo from server
        $pledgeImage = public_path('uploads/').$currentImage;
        if(file_exists($pledgeImage)){
            @unlink($pledgeImage);
        } 
        $pledge->update($request->all());   
        }else{
        $pledge->update($request->all());    
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
        $pledge = Pledge::findOrFail($id);

        //delete pledge
        $pledge->delete();
        return (['message' => 'Pledge deleted']);
    }    
}
