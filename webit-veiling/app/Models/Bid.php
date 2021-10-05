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
    ];

    public $timestamps = true;

    public function bid() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public static function checkIfHighestBidder($given_amount, $product_id) {
        $highest_bid = Bid::where('product_id', $product_id)
        ->orderBy('price', 'DESC')
        ->pluck('price')
        ->first();

        return ($highest_bid < $given_amount || $highest_bid == null) ?  true : false;
    }
}
