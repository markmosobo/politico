<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MoreAbout;
use App\Models\Tag;

class MoreAboutController extends Controller
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
        $moreabout = MoreAbout::latest()->paginate(3);
        return response()->json($moreabout);
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
            'attribute' => 'required|string|max:191',
            'description' => 'required|string',
        ]);

        $user = auth('api')->user();
        
        if($request->photo){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);
            
            $moreabout = MoreAbout::create([
                'attribute' => $request['attribute'],
                'description' => $request['description'],
                'photo' => $request['photo']
            ]);

            //update pivot table
            $tag_ids = [];
                foreach ($request->get('tags') as $tag) {
                    $existingtag = Tag::whereName($tag['text'])->first();
                    if ($existingtag) {
                        $tag_ids[] = $existingtag->id;
                    } else {
                        $newtag = Tag::create([
                            'name' => $tag['text']
                        ]);
                        $tag_ids[] = $newtag->id;
                    }
                }
            $moreabout->tags()->sync($tag_ids); 

        return response()->json($moreabout);
        }else{
            $moreabout = MoreAbout::create([
                'attribute' => $request['attribute'],
                'description' => $request['description'],
                'photo' => $request['photo']
            ]);

           //update pivot table
            $tag_ids = [];
                foreach ($request->get('tags') as $tag) {
                    $existingtag = Tag::whereName($tag['text'])->first();
                    if ($existingtag) {
                        $tag_ids[] = $existingtag->id;
                    } else {
                        $newtag = Tag::create([
                            'name' => $tag['text']
                        ]);
                        $tag_ids[] = $newtag->id;
                    }
                }
            $moreabout->tags()->sync($tag_ids); 
            
        return response()->json($moreabout);        
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
        $moreabout = MoreAbout::findOrFail($id);

        $this->validate($request,[
            'attribute' => 'required|string|max:191',
            'description' => 'required|string',
        ]);

        $currentImage = $moreabout->photo;

        if($request->photo != $currentImage){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['image' => $name]);

         //delete old photo from server
        $moreaboutImage = public_path('uploads/').$currentImage;
        if(file_exists($moreaboutImage)){
            @unlink($moreaboutImage);
        } 
        $moreabout->update($request->all());   
        }else{
        $moreabout->update($request->all());    
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
        $moreabout = MoreAbout::findOrFail($id);

        //delete post
        $moreabout->delete();
        return (['message' => 'Post deleted']);
    }
   
}
