<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Bid;

class adminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);

        return view('./admin/dashboard')->with('data', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input
        $validator =  Validator::make($request->all(),[
            'product_title' => 'required|max:150',
            'product_price' => 'required',
            'end_date' => 'required',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/products')
            ->withErrors($validator);
        }

        // Make file link
        if ( !is_null ($request->file('file')) ) {
            $unique_photo_url = Product::makeFileLink($request->file('file'), null);
        }

        // Save product
        $product = new Product([
            "name" => $request->input('product_title'),
            "start_price" => $request->input('product_price'),
            "close_date" => $request->input('end_date'),
            "img_url" => $unique_photo_url
        ]);

        $product->save();

        return redirect('/products')
        ->with('success', 'Product is succesvol toegevoegd');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $user_bids = Bid::getBidsForProduct($product);

        return view('./admin/product_bids')
        ->with(['data' => $product,
                'bids' => $user_bids]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Validate input
        $validator =  Validator::make($request->all(),[
            'product_title' => 'required|max:150',
            'product_price' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator);
        }
        
        // Make file link
        if ( !is_null ($request->file('file')) ) {
            $product->img_url = Product::makeFileLink($request->file('file'), $product);
        }

        $product->name = $request->input('product_title');
        $product->start_price = $request->input('product_price');
        $product->close_date = $request->input('end_date');
        $product->save();

        return back()
            ->with('success', 'Product changed successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = Product::find($product);
        $product->each->delete();

        return redirect('/products')
        ->with('success', 'Product removed successfully');
    }
}
