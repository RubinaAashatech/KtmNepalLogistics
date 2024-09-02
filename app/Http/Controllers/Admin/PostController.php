<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilityFunctions;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission', 'view_posts'), 403);

        $posts = Post::latest()->paginate(50);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'create_posts'), 403);

        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'create_posts'), 403);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'type' => 'required',
        ]);
        // $imagePath = $request->file('image')->storeAs('images/post', Carbon::now() . substr(str_replace(['.', '?', '/'], '-', $request->title), 0, 50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
     
        $imagePath = time() . '-' . $request->image->extension();
        $request->image->move(public_path('uploads/post'), $imagePath);
     
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->slug = substr(str_replace('/', '-', $request->title), 0, 500);
        $post->type = $request->type;
        $post->image = $imagePath;
        if ($post->save()) {
            UtilityFunctions::createHistory('Created Post with Id ' . $post->id . ' and title ' . $post->title, 1);
            return redirect()->route('admin.posts.index')->with(['successMessage' => 'Success!! Post Created']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! Post not Created']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission', 'update_posts'), 403);

        $post = Post::find($id);
        return view('admin.post.update', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        abort_unless(Gate::allows('hasPermission', 'update_posts'), 403);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'type' => 'required',
        ]);
        $post = Post::find($request->id);
        if ($request->hasFile('image')) {
            // $imagePath = $request->file('image')->storeAs('images/post', Carbon::now() . substr(str_replace(['.', '?', '/'], '-', $request->title), 0, 50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
            // Storage::delete('public/' . $post->image);

            $imagePath = time() . '-' . $request->image->extension();
            $request->image->move(public_path('uploads/post'), $imagePath);
         
            $post->image = $imagePath;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->slug = substr(str_replace('/', '-', $request->title), 0, 500);
        $post->type = $request->type;
        if ($post->save()) {
            UtilityFunctions::createHistory('Updated Post with Id ' . $post->id . ' and title ' . $post->title, 1);
            return redirect()->route('admin.posts.index')->with(['successMessage' => 'Success!! Post Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! Post not Updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission', 'delete_posts'), 403);

        $post = Post::find($id);
        if ($post->delete()) {
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            UtilityFunctions::createHistory('Deleted Post with Id ' . $post->id . ' and title ' . $post->title, 1);
            return redirect()->route('admin.posts.index')->with(['successMessage' => 'Success !! Post Deleted']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error Post not Deleted']);
        }
    }
}
