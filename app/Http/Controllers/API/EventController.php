<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
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
        $events = Event::latest()->paginate(10);
        return response()->json($events);
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
            // 'category' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'venue' => 'required|string',
            'details' => 'required|string'
        ]);

        $user = auth('api')->user();
        
        if($request->photo){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);
            
            $event = Event::create([
                'title' => $request['title'],
                'category' => $request['category'],
                'date' => $request['date'],
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'venue' => $request['venue'],
                'photo' => $request['photo'],
                'details' => $request['details']
            ]);

        return response()->json($event);
        }else{
            $event = Event::create([
                'title' => $request['title'],
                'category' => $request['category'],
                'date' => $request['date'],
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'venue' => $request['venue'],
                'photo' => $request['photo'],
                'details' => $request['details']
            ]);
            
        return response()->json($event);        
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
        $event = Event::findOrFail($id);

        $this->validate($request,[
            'title' => 'required|string|max:191',
            // 'category' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'venue' => 'required|string',
            'details' => 'required|string'
        ]);

        $currentImage = $event->photo;

        if($request->photo != $currentImage){
            $name = time().'.'.explode('/',explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('uploads/').$name);
            $request->merge(['photo' => $name]);

         //delete old photo from server
        $eventImage = public_path('uploads/').$currentImage;
        if(file_exists($eventImage)){
            @unlink($eventImage);
        } 
        $event->update($request->all());   
        }else{
        $event->update($request->all());    
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
        $event = Event::findOrFail($id);

        //delete event
        $event->delete();
        return (['message' => 'Event deleted']);
    }
   
}
