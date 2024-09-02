<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilityFunctions;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission','view_clients'),403);

       
        $clients = Client::latest()->paginate(50);

        return view('admin.client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission','create_clients'),403);
        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','create_clients'),403);

        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);
        try {
            // $imagePath = $request->file('image')->storeAs('images/client', Carbon::now() . substr(str_replace(['.','?','/'], '-', $request->name),0,50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
          
            $imagePath = time() . '-' . $request->image->extension();
            $request->image->move(public_path('uploads/client'), $imagePath);
          
            $client = new Client;
            $client->name = $request->name;
            $client->image = $imagePath;

            if ($client->save()) {
                UtilityFunctions::createHistory('Created Client with Id ' . $client->id . ' and name ' . $client->name, 1);
                return redirect()->route('admin.clients.index')->with(['successMessage' => 'Success!! Client created']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Client not created']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Client $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission','update_clients'),403);

        $client=Client::find($id);
        return view('admin.client.update',['client'=>$client]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
     {
        abort_unless(Gate::allows('hasPermission','update_clients'),403);

        $this->validate($request, [
            'id'=>'required',
            'name' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);
        try {
            $client = Client::find($request->id);
            if ($request->hasFile('image')) {
                // $imagePath = $request->file('image')->storeAs('images/client', Carbon::now() . substr(str_replace(['.','?','/'], '-', $request->name),0,50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
               
            // Storage::delete('public/'.$client->image);

                // Storage::disk('public')->put("iamges/sitesetting/{$imagePath}", $decoded_string);

                $imagePath = time() . '-' . $request->image->extension();
                $request->image->move(public_path('uploads/client'), $imagePath);
                $client->image = $imagePath;

            }
            $client->name = $request->name;
            if ($client->save()) {
                UtilityFunctions::createHistory('Updated Client with Id ' . $client->id . ' and name ' . $client->name, 1);
                return redirect()->route('admin.clients.index')->with(['successMessage' => 'Success!! Client Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Client not Updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission','delete_clients'),403);

        try {
            $client=Client::find($id);
            if ($client->delete()) {
                Storage::delete('public/'.$client->image);
                UtilityFunctions::createHistory('Deleted Ad with Id ' . $client->id . ' and name ' . $client->name, 1);
                return redirect()->route('admin.clients.index')->with(['successMessage' => 'Success !! Client Deleted']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Client not Deleted']);
            }

        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }
}
