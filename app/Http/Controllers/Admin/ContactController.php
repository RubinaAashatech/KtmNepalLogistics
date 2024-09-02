<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('hasPermission','view_contacts'),403);

        $contacts = Contact::latest()->paginate(50);
        return view('admin.contact.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);
        $contact = Contact::create($request->all());
        if (isset($contact)) {
            Session::flash('success', 'Your request has been received. We will contact you soon.');
            return redirect()->back();
        } else {
            Session::flash('error', 'Error !! Failed to send contact request.');
            return redirect()->back();
        }
    }
}
