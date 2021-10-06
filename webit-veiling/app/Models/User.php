<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public static function getUserWinningBids($user) {
        if(! $user) {
            return null;
        }

        $bids = $user->bids()
        ->where('is_lost', 0)
        ->join('products', 'bids.product_id', '=', 'products.id')
        ->get();

        return (count($bids) > 0) ? $bids : null;
    }

    public static function getBidHistory($user) {
        if(! $user) {
            return null;
        }

        $bids = $user->bids()
        ->join('products', 'bids.product_id', '=', 'products.id')
        ->get();

        return (count($bids) > 0) ? $bids : null;
    }

    public static function checkIfUserHasBidOnProduct($id) {
        $bids = Auth::user()->bids
        ->where('product_id', $id);

        return count($bids);
    }

    public static function getHighestUserBidOnProduct($id) {
        $bid = Auth::user()->bids  
        ->where('product_id', $id)
        ->sortByDesc('price')
        ->first();

        return $bid ? "You are the highest bidder with a price of €" . $bid->price : "";
    }
}
