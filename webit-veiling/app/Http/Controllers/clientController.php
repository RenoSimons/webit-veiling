<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Bid;

class clientController extends Controller
{
    public function index() {
        $products = Product::paginate(9);

        return view('./clients/product_overview')->with('data', $products);
    }

    public function detail(Product $product) {
        $bids = $product->bids()->orderBy('price', 'DESC')->get();

        return view('./clients/product_detail')->with(
        ['data' => $product, 'bids' => $bids ]);
    }

    public function placeBid(Request $request, Product $product) {
        // Validate input
        $validator =  Validator::make($request->all(),[
            'user_bid' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return Redirect()->back()
            ->withInput()
            ->withErrors($validator);
        }

        // Check if highest bid
        if ( ! Bid::checkIfHighestBidder($request->user_bid, $product) ) {
            return Redirect()->back()
            ->withErrors(["Make sure your bid is higher than existing bids or the starting price"]);
        }

        // Save bid
        $bid = new Bid([
            "user_id" => Auth::id(),
            "price" => $request->input('user_bid'),
            "product_id" => $product->id,
        ]);

        $bid->save();

        return view('./clients/thank');
    }
}
