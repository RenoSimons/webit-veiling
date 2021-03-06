<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Models\Product;
use App\Models\Bid;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\bidPlacedMail;

class clientController extends Controller
{
    public function index() {
        $now = Carbon::today();

        $products = Product::query()
        ->where('close_date' , '>', $now)
        ->orderBy('close_date', 'ASC')
        ->paginate(10);

        // If user logged in, get their bids with products
        $user = Auth::user();
        $user_winning_bids = User::getUserWinningBids($user);
        $user_bid_history = User::getBidHistory($user);
    
        return view('./clients/product_overview')
        ->with(['data' => $products,
                'user_bids' => $user_winning_bids,
                'bid_history' => $user_bid_history]);
    }

    public function detail(Product $product) {
        $bids = Bid::getBidsForProduct($product);

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

        // Update previous bids to lost
        Bid::updateBidsToLost($product);

        // Save bid
        $bid = new Bid([
            "user_id" => Auth::id(),
            "price" => $request->input('user_bid'),
            "product_id" => $product->id,
        ]);
        $bid->save();

        // Update product
        $product->highest_offer = $request->input('user_bid');
        $product->save();

        // Send thanks mail
        Mail::to($request->user())->send(new bidPlacedMail($product));

        return view('./clients/thank');
    }

    public function removeBid($product_id) {
        $bid_id = Auth::user()->bids
        ->where('is_lost', 0)
        ->where('product_id', $product_id)
        ->pluck('id');

        if ($bid_id) {
            Bid::destroy($bid_id);
            
            // Assign new highest bid back to previous winner
            Bid::updateValidBid($product_id);

            return redirect()->route('home');
        }

        return redirect()->route('home')->with('error', 'Bid not found');
    }
}
