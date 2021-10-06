<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'is_lost'
    ];

    public $timestamps = true;

    public function bid() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->hasOne(Product::class);
    }

    public static function getBidsForProduct($product) {
        $bids = $product->bids()->orderBy('price', 'DESC')->get();

        return $bids;
    }

    public static function checkIfHighestBidder($given_amount, $product) {
        $highest_bid = Bid::where('product_id', $product->id)
        ->orderBy('price', 'DESC')
        ->pluck('price')
        ->first();

        return ($highest_bid < $given_amount || $highest_bid == null) &&  $product->start_price < $given_amount ?  true : false;
    }

    public static function updateBidsToLost($product) {
        foreach($product->bids as $bid) {
            $bid->is_lost = 1;
            $bid->save();
        }
    }
}
