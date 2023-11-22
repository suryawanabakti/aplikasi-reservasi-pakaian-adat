<?php

namespace App\Http\Controllers\AdminToko;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Alert;

class ProductController extends Controller
{
    //
    public function index()
    {
        if (!auth()->user()->toko) {
            Alert::info('Toko Belum Ada', 'silakan mengupdate toko terlebih dahulu');
            return view('admintoko.profile.index');
        }

        $products = Product::where('user_id', auth()->id())->get();
        $categories = Category::all();
        return view('admintoko.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        // pakai modal
        return view('admintoko.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($request->has('image')) {
            $image = $request->image;
            $imageName = time() . $image->getClientOriginalName();
            $image->move('uploads/image', $imageName);
            $validatedData['image'] = $imageName;
        }
        $validatedData['user_id'] = auth()->id();
        Product::create($validatedData);
        return back();
    }

    public function update(Request $request, $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($request->has('image')) {
            $image = $request->image;
            $imageName = time() . $image->getClientOriginalName();
            $image->move('uploads/image', $imageName);
            $validatedData['image'] = $imageName;
        }
        $validatedData['user_id'] = auth()->id();
        Product::where('id', $product)->update($validatedData);
        return back();
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            unlink(public_path('/uploads/image/' . $product->image));
        }
        Product::destroy($product->id);

        return back();
    }
}
