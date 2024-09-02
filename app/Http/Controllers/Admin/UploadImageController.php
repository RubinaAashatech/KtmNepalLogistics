<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UploadImageController extends Controller
{
    public function upload_image(Request $request){
        abort_unless(Gate::allows('hasPermission','upload_images'),403);
        //Fake model for column values as it is not associated to a real model
        $image = new Image;
        $image->id=0;
        $image->exists = true;
        $imagepath = $image->addMediaFromRequest('upload')->toMediaCollection('images','');
        return response()->json([
            'url'=>$imagepath->getUrl()
        ]);

        // return response()->json([
        //     'url'=>'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.incisiv.io%2Fhubfs%2Fhello-world.png%23keepProtocol&f=1&nofb=1'
        // ]);
    }
}
