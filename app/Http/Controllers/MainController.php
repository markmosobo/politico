<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\About;
use App\Models\News;
use App\Models\MoreAbout;
use App\Models\Pledge;
use App\Models\Issue;

class MainController extends Controller
{
    public function index()
    {
        $events = Event::latest()->take(3)->get();
        $abouts = About::latest()->take(1)->get();
        $moreabouts = MoreAbout::latest()->take(3)->get();
        $news = News::latest()->paginate(3);
        $pledge = Pledge::latest()->paginate(1);
        $issues = Issue::latest()->paginate(4);
        return view('index',compact('events','abouts',
        'news','moreabouts','pledge','issues'));
    }
}
