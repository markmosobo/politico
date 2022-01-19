<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
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
        $news = News::latest()->paginate(10);
        return response()->json($news);
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
            'headline' => 'required|string|max:191',
            'details' => 'required|string'
        ]);

        $user = auth('api')->user();
        
        if($request->photo){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/news/').$name);
            $request->merge(['photo' => $name]);
            
            $news = News::create([
                'headline' => $request['headline'],
                'photo' => $request['photo'],
                'details' => $request['details'],
                'slug' => $request['slug']
            ]);

        return response()->json($news);
        }else{
            $news = News::create([
                'headline' => $request['headline'],
                'photo' => $request['photo'],
                'details' => $request['details'],
                'slug' => $request['slug']
            ]);
            
        return response()->json($news);        
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
        $news = News::findOrFail($id);

        $this->validate($request,[
            'headline' => 'required|string|max:191',
            'details' => 'required|string'
        ]);

        $currentImage = $news->photo;

        if($request->photo != $currentImage){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/news/').$name);
            $request->merge(['photo' => $name]);

         //delete old photo from server
        $newsImage = public_path('uploads/news/').$currentImage;
        if(file_exists($newsImage)){
            @unlink($newsImage);
        } 
        $news->update($request->all());   
        }else{
        $news->update($request->all());    
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
        $news = News::findOrFail($id);

        //delete news
        $news->delete();
        return (['message' => 'News deleted']);
    }    
}
