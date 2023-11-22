<?php

namespace App\Http\Controllers\AdminToko;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Alert;
use App\Models\Cart;
use App\Models\Product;
use App\Notifications\RegisterNotification;
use Illuminate\Support\Facades\DB;
use Notification;

class TransactionController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!auth()->user()->toko) {
            Alert::info('Toko Belum Ada', 'silakan mengupdate toko terlebih dahulu');
            return view('admintoko.profile.index');
        }
        $transactions = Transaction::where('toko_id', auth()->user()->toko->id ?? 0)->orderBy('created_at', 'desc');
        if ($request->mulai && $request->sampai) {
            $transactions->whereBetween(DB::raw('DATE(created_at)'), [$request->mulai, $request->sampai]);
        }
        $transactions = $transactions->get();
        return view('admintoko.transactions.index', compact('transactions'));
    }

    public function print()
    {
        $transactions = Transaction::where('toko_id', auth()->user()->toko->id)
            ->where('status', 'diterima')
            ->get();

        return view('admintoko.transactions.print', compact('transactions'));
    }

    public function terima($id)
    {
        $trans = Transaction::find($id);
        Transaction::find($id)->update(['status' => 'success']);
        $toko = $trans->toko->name;
        foreach ($trans->carts as $cart) {
            $product = Product::find($cart->product_id)->first();
            if ($cart->jumlah > $product->stock) {
                return back();
            }
            Product::find($cart->product_id)->update([
                'stock' => $product->stock - $cart->jumlah,
            ]);
        }
        return back();
    }

    public function diterima($id)
    {
        $trans = Transaction::find($id);
        foreach ($trans->carts as $cart) {
            $product = Product::find($cart->product_id)->first();
            Product::find($cart->product_id)->update([
                'stock' => $product->stock + $cart->jumlah,
            ]);
        }

        Transaction::find($id)->update(['status' => 'diterima']);

        return back();
    }
}
