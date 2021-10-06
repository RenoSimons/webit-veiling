<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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

    public static function makeFileLink($file, $product) {
        // If there already is an image for this product, delete and replace this
        if($product) {
            Storage::disk('product_images')->delete($product->img_url);
        }

        $unique_photo_url = $file->hashName();
        $file->store('product_images', 'public');

        return $unique_photo_url;
    }
}
