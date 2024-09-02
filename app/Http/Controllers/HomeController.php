<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::latest()->get()->take(50);
        $services = Service::latest()->get()->take(4);
        $images = Image::latest()->get()->take(3);
        $news = Post::whereType('news')->latest()->get()->take(5);
        $events = Post::whereType('event')->latest()->get()->take(5);
        // dd($news,$events);
        return view('portal.index',compact('clients','services','images','news','events'));
    }
}
