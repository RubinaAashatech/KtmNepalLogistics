<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilityFunctions;

class ImageController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission','view_images'),403);

       
        $images = Image::latest()->paginate(50);

        return view('admin.image.index', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission','create_images'),403);
        return view('admin.image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','create_images'),403);

        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);
        try {
            // $imagePath = $request->file('image')->storeAs('images/gallery', Carbon::now() . substr(str_replace(['.','?','/'], '-', $request->title),0,50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
            $image = new Image;
            
            $imagePath = time() . '-' . $request->image->extension();
            $request->image->move(public_path('uploads/gallery'), $imagePath);
            $image->image = $imagePath;
            $image->title = $request->title;
            

            if ($image->save()) {
                UtilityFunctions::createHistory('Created Image with Id ' . $image->id . ' and title ' . $image->title, 1);
                return redirect()->back()->with(['successMessage' => 'Success!! Image created']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Image not created']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Image $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission','update_images'),403);

        $image=Image::find($id);
        return view('admin.image.update',['image'=>$image]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','update_images'),403);

        $this->validate($request, [
            'id'=>'required',
            'title' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);
        try {
            $image = Image::find($request->id);
            if ($request->hasFile('image')) {
                 $imagePath = time() . '-' . $request->image->extension();
                 $request->image->move(public_path('uploads/gallery'), $imagePath);
                 $image->image = $imagePath;
            }
            $image->title = $request->title;
            if ($image->save()) {
                UtilityFunctions::createHistory('Updated Image with Id ' . $image->id . ' and name ' . $image->title, 1);
                return redirect()->route('admin.images.index')->with(['successMessage' => 'Success!! Image Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Image not Updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission','delete_images'),403);

        try {
            $image=Image::find($id);
            if ($image->delete()) {
                Storage::delete('public/'.$image->image);
                UtilityFunctions::createHistory('Deleted Image with Id ' . $image->id . ' and name ' . $image->title, 1);
                return redirect()->route('admin.images.index')->with(['successMessage' => 'Success !! Image Deleted']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Image not Deleted']);
            }

        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }
}
