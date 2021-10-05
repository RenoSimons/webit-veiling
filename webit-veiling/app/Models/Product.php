<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bid;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_price',
        'img_url',
        'close_date',
        'description'
    ];

    public $timestamps = true;

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public static function checkIfDateValid($product) {
        $dt = Carbon::createFromDate($product->close_date);

        return ($dt->isPast()) ? false : true;
    }
}
