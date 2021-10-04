<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class adminDashboardController extends Controller
{
    public function index() {
        return view('./admin/dashboard');
    }

    public function addProduct(Request $request) {
        // Validate input
        $validator =  Validator::make($request->all(),[
            'product_title' => 'required|max:150',
            'product_price' => 'required',
            'end_date' => 'required',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/dashboard')
            ->withErrors($validator);
        }

        // Make file link
        if ( !is_null ($request->file('file')) ) {
            $unique_photo_url = $request->file->hashName();
            
            $request->file->store('product_images', 'public');
        }

        // Save product
        $product = new Product([
            "name" => $request->input('product_title'),
            "start_price" => $request->input('product_price'),
            "close_date" => $request->input('end_date'),
            "img_url" => $unique_photo_url
        ]);

        $product->save();

        return redirect('/dashboard')
        ->with('success', 'Product is succesvol toegevoegd');
    }
}
