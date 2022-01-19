<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issue;

class IssueController extends Controller
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
        $issues = Issue::latest()->paginate(4);
        return response()->json($issues);
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
            'name' => 'required|string|max:191',
            'details' => 'required|string'
        ]);

        $user = auth('api')->user();
        
        if($request->photo){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);
            
            $issue = Issue::create([
                'name' => $request['name'],
                'details' => $request['details'],
                'photo' => $request['photo']
            ]);

        return response()->json($issue);
        }else{
            $issue = Issue::create([
                'name' => $request['name'],
                'details' => $request['details'],
                'photo' => $request['photo']
            ]); 
            
        return response()->json($issue);        
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
        $issue = Issue::findOrFail($id);

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'details' => 'required|string'
        ]);

        $currentImage = $issue->photo;

        if($request->photo != $currentImage){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);

         //delete old photo from server
        $issueImage = public_path('uploads/').$currentImage;
        if(file_exists($issueImage)){
            @unlink($issueImage);
        } 
        $issue->update($request->all());   
        }else{
        $issue->update($request->all());    
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
        $issue = Issue::findOrFail($id);

        //delete issue
        $issue->delete();
        return (['message' => 'Post deleted']);
    }
   
}
