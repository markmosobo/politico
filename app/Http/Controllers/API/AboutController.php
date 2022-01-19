<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        return About::latest()->paginate(1);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'mission' => 'required|integer',
            'introduction' => 'required|string|max:255'
        ]);

        return About::create([
            'mission' => $request->get('mission'),
            'introduction' => $request->get('introduction'),
            'media' => $request['media']
        ]);
    }

    public function update(Request $request,$id)
    {
        $about = About::findOrFail($id);

        $this->validate($request,[
            'mission' => 'required|integer',
            'introduction' => 'required|string|max:255'
        ]);
        
        $about->update($request->all());
    }

    public function destroy(Request $request,$id)
    {
        $about = About::findOrFail($id);

        $about->delete();
        return (['message' => 'deleted']);
    }    
}
