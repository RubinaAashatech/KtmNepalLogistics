<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Models\Service;
use Illuminate\Http\Request;

class RenderController extends Controller
{
    public function render_gallery(Request $request)
    {
        $images = Image::latest()->paginate(50);
        $news = Post::whereType('news')->latest()->get()->take(5);
        return view('portal.render-gallery', ['images' => $images, 'title' => '| Gallery', 'news' => $news]);
    }


    public function render_service($id)
    {
        $service = Service::find($id);
        $news = Post::whereType('news')->latest()->get()->take(5);
        return view('portal.render-services', ['service' => $service, 'title' => '| ' . $service->title, 'news' => $news]);
    }
    public function render_posts($id)
    {
        $post = Post::find($id);
        $title = '| '.$post->title;
        $news = Post::whereType('news')->latest()->get()->take(5);
        return view('portal.render-posts', compact('post','title','news'));
    }

    public function render_quotations()
    {
        return view('portal.render-quotations');
    }
    public function render_contact()
    {
        return view('portal.render-contact');
    }
}
