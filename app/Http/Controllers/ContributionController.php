<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use App\Models\About;
use App\Models\News;
use App\Models\MoreAbout;
use App\Models\Pledge;
use App\Models\Issue;
use App\Models\Photo;
use App\Models\Slide;

class ContributionController extends Controller
{
    public function contribute(){
        $events = Event::latest()->take(3)->get();
        $abouts = About::latest()->take(1)->get();
        $moreabouts = MoreAbout::latest()->with('tags')->take(3)->get();
        $news = News::latest()->paginate(3);
        $pledge = Pledge::latest()->paginate(1);
        $issues = Issue::latest()->paginate(4);
        $photos = Photo::latest()->get();
        $slides = Slide::latest()->take(3)->get();
        $events = Event::latest()->paginate(3);
        return view('index',compact('events','abouts',
        'news','moreabouts','pledge','issues','photos','slides','events'));
    }

    public function postContribution(Request $request){
        $rules = [
            'recepient' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|min:3|max:255',
            'amount' => 'required|integer',
            'reason' => 'sometimes|string'
        ];

       $validator = Validator::make($request->all(),$rules);
       if ($validator->fails()){
           return redirect('contribute')
               ->withInput()
               ->withErrors($validator);
       }
       else{
           $data = $request->input();
           try {               
                $contribution = new Contribution;
                $contribution->phone_number = $data['phone_number'];
                $contribution->email= $data['email'];
                $contribution->recepient = $data['recepient'];
                $contribution->amount = $data['amount'];
                $contribution->reason = $data['reason'];
                $contribution->save();                
               return redirect('contribute')->with('status','Contribution sent!');
           }
           catch(Exception $e){
               return redirect('contribute')->with('failed',"operation failed");
           }
       }
    }    
}
