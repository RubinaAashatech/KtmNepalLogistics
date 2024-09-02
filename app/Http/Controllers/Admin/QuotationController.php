<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::latest()->paginate(50);
        return view('admin.quotation.index', compact('quotations'));
    }

    public function store(Request $request)
    {
        if (Quotation::create($request->all())) {
            $request->session()->flash('success', 'Your request has been received. We will contact you soon.');
            return redirect()->back();
        }else{
            $request->session()->flash('error', 'Error!! Please recheck your form data.');
            return redirect()->back();
        }
    }

    public function show($id){
        $quotation = Quotation::findOrFail($id);
        return view('admin.quotation.view',compact('quotation'));
    }
}
