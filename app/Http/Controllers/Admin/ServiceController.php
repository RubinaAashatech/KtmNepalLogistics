<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilityFunctions;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission','view_services'),403);

       
        $services = Service::latest()->paginate(50);

        return view('admin.service.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission','create_services'),403);
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','create_services'),403);

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);
        try {
            // $imagePath = $request->file('image')->storeAs('images/service', Carbon::now() . substr(str_replace(['.','?','/'], '-', $request->title),0,50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
           
            
            $imagePath = time() . '-' . $request->image->extension();
            $request->image->move(public_path('uploads/service'), $imagePath);
            
            $service = new Service;
            $service->title = $request->title;
            $service->description = $request->description;
            $service->content = $request->content;
            $service->image = $imagePath;
            

            if ($service->save()) {
                UtilityFunctions::createHistory('Created Service with Id ' . $service->id . ' and title ' . $service->title, 1);
                return redirect()->route('admin.services.index')->with(['successMessage' => 'Success!! Service created']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Service not created']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Service $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission','update_services'),403);

        $service=Service::find($id);
        return view('admin.service.update',['service'=>$service]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','update_services'),403);

        $this->validate($request, [
            'id'=>'required',
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);
        try {
            $service = Service::find($request->id);
            if ($request->hasFile('image')) {
                // $imagePath = $request->file('image')->storeAs('images/service', Carbon::now() . substr(str_replace(['.','?','/'], '-', $request->title),0,50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
             
             
             
                // Storage::delete('public/'.$service->image);
                // $service->image = $imagePath;

                $imagePath = time() . '-' . $request->image->extension();
                $request->image->move(public_path('uploads/service'), $imagePath);
                $service->image = $imagePath;
            }
            $service->title = $request->title;
            $service->description = $request->description;
            $service->content = $request->content;
            if ($service->save()) {
                UtilityFunctions::createHistory('Updated Service with Id ' . $service->id . ' and title ' . $service->title, 1);
                return redirect()->route('admin.services.index')->with(['successMessage' => 'Success!! Service Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Service not Updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission','delete_services'),403);

        try {
            $service=Service::find($id);
            if ($service->delete()) {
                Storage::delete('public/'.$service->image);
                UtilityFunctions::createHistory('Deleted Ad with Id ' . $service->id . ' and title ' . $service->title, 1);
                return redirect()->route('admin.services.index')->with(['successMessage' => 'Success !! Service Deleted']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Service not Deleted']);
            }

        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }
}
