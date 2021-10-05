<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class clientController extends Controller
{
    public function index() {
        $products = Product::paginate(10);

        return view('./admin/dashboard')->with('data', $products);
    }
}
