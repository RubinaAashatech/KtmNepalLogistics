<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    public function index(){
        abort_unless(Gate::allows('hasPermission','view_subscriptions'),403);

        $subscriptions = Subscription::latest()->paginate(50);
        return view('admin.subscription.index',compact('subscriptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $subscription = Subscription::create($request->all());
        if (isset($subscription)) {
            Session::flash('success', 'You have successfully subscribed to our newsletter');
            return redirect()->back();
        } else {
            Session::flash('error', 'Error !! Failed to subscribe to newsletter');
            return redirect()->back();
        }
    }
}
