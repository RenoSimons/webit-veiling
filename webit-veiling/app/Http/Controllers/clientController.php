<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class clientController extends Controller
{
    public function index() {
        $products = Product::paginate(9);

        return view('./clients/product_overview')->with('data', $products);
    }
}
