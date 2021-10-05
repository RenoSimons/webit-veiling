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
        $now = \Carbon\Carbon::today();

        $products = Product::query()
        ->where ('close_date' , '<', $now)->paginate(9);
        
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

        // Check if product hasn't reached end date at time of request
        if ( ! Product::checkIfDateValid($product) ) {
            return Redirect()->back()
            ->withErrors(["This bid offering has come to an end"]);
        }
        Product::checkIfDateValid($product);

        // Save bid
        $bid = new Bid([
            "user_id" => Auth::id(),
            "price" => $request->input('user_bid'),
            "product_id" => $product->id,
        ]);
        $bid->save();

        $product->highest_offer = $request->input('user_bid');
        $product->save();

        return view('./clients/thank');
    }
}
