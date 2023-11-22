<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Toko;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    //
    public function index(Request $request)
    {

        $tokos = Toko::all();
        $products = Product::with('toko')->addSelect([
            'terjual' => Cart::selectRaw('sum(jumlah) as total')
                ->whereColumn('product_id', 'products.id')
                ->where('status', 'checkout')
                ->groupBy('product_id')
        ])
            ->orderBy('terjual', 'DESC')
            ->get()
            ->toArray();
        if ($request->user_id) {
            $products = Product::with('toko')->addSelect([
                'terjual' => Cart::selectRaw('sum(jumlah) as total')
                    ->whereColumn('product_id', 'products.id')
                    ->where('status', 'checkout')
                    ->groupBy('product_id')
            ])
                ->where('user_id', $request->user_id)
                ->orderBy('terjual', 'DESC')
                ->get()
                ->toArray();
        }

        return view('adminsuper.featured-product.index', compact('products', 'tokos'));
    }
}
