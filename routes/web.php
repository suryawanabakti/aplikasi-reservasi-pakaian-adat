<?php

// use App\Http\Controllers\Public\CartController;

use App\Http\Controllers\AdminSuper\BannerController;
use App\Http\Controllers\AdminSuper\CategoryController;
use App\Http\Controllers\AdminSuper\TokoController;
use App\Http\Controllers\AdminSuper\TransactionController as AdminSuperTransactionController;
use App\Http\Controllers\AdminSuper\UsersController;
use App\Http\Controllers\AdminToko\ProductController;
use App\Http\Controllers\AdminToko\ProfileController;
use App\Http\Controllers\AdminToko\TransactionController as AdminTokoTransactionController;
use App\Http\Controllers\FeaturedProductController;
use App\Http\Controllers\LupasPasswordController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\TransactionController;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Toko;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $events = Banner::orderBy('created_at', 'desc')->take(6)->get();
    return view('welcome', compact('events'));
});

Route::get('/lupa-password', [LupasPasswordController::class, 'index']);
Route::post('/lupa-password', [LupasPasswordController::class, 'changePassword']);
Route::get('/lupa-password/get-email', [LupasPasswordController::class, 'getEmail']);


Route::get('/home', function (Request $request) {
    $title = 'Home';
    $products = Product::paginate(12);
    if ($request->search) {
        $products = Product::where('name', 'LIKE', "%{$request->search}%")->paginate(12);
    }
    $categories = Category::all();
    $carts = Cart::where('user_id', auth()->user()->id ?? 0)
        ->where('status', 'process')
        ->orderBy('created_at', 'desc')
        ->get() ?? null;
    $banners = Banner::all();
    return view('public.home', compact('products', 'title', 'categories', 'carts', 'banners'));
})->name('home');

Route::get('/home/{category}', function (Request $request, $category) {

    $title = 'Home';


    $products = Product::where('category_id', $category)->paginate(12);
    if ($request->search) {
        $products = Product::where('category_id', $category)->where('name', 'LIKE', "%{$request->search}%")->paginate(12);
    }

    $categories = Category::all();
    $carts = Cart::where('user_id', auth()->user()->id ?? 0)
        ->where('status', 'process')
        ->orderBy('created_at', 'desc')
        ->get() ?? null;
    $banners = Banner::all();
    return view('public.home', compact('products', 'title', 'categories', 'carts', 'banners'));
})->name('home.category');



Route::get('/checkout', function (Request $request) {

    if ($request->has('toko_id')) {
        $carts = Cart::where('user_id', auth()->user()->id ?? 0)
            ->where('status', 'process')
            ->orderBy('created_at', 'desc')
            ->get() ?? null;

        $x = 0;
        foreach ($request->toko_id as $toko_id) {
            if ($x == 0) {
            } else {

                if ($request->toko_id[$x] !== $request->toko_id[$x - 1]) {
                    Alert::error('Terjadi Kesalahan', "Tidak bisa checkout dengan beda toko, harap centang produk dengan toko yang sama");
                    return back();
                }
            }

            $x++;
        }


        //  $checkouts =  DB::select('select *,products.name AS nama_produk ,tokos.id AS toko_id,products.user_id AS product_user_id,carts.user_id as carts_user_id from carts  inner join products on carts.product_id = products.id inner join tokos on tokos.user_id = products.user_id where carts.user_id = '. auth()->user()->id . ' AND tokos.id = '. $toko_id);\

        $checkouts = Cart::with('product', 'toko')->where('toko_id', $toko_id)->where('user_id', auth()->id())->where('status', 'process')->get();
        return view('public.checkout', compact('checkouts', 'carts'));
    } else {
        Alert::error('Gagal Checkout', 'tolong ceklist setidaknya SATU produk satu produk');
        return back();
    }
});

Route::get('/products/{product}', function (Product $product) {
    $carts = Cart::where('user_id', auth()->user()->id ?? 0)
        ->where('status', 'process')
        ->orderBy('created_at', 'desc')
        ->get() ?? null;
    return view('public.detail-product', compact('product', 'carts'));
})->name('public.products.show');

Route::get('/tokos/{toko}', function (Toko $toko) {
    $carts = Cart::where('user_id', auth()->user()->id ?? 0)
        ->where('status', 'process')
        ->orderBy('created_at', 'desc')
        ->get() ?? null;
    $products = Product::where('user_id', $toko->user_id)->get();
    return view('public.detail-toko', compact('toko', 'carts', 'products'));
})->name('public.tokos.show');

Route::group(['middleware' => ['auth']], function () {
    Route::controller(CartController::class)->group(function () {
        Route::get('/carts', 'index')->name('carts.index');
        Route::get('/carts/destroy/{cart}', 'destroy')->name('carts.destroy');
        Route::get(
            '/carts/update-jumlah/{cart}',
            'updateJumlah'
        )->name('carts
        .updateJumlah');
        Route::post('/carts', 'store')->name('carts.store');
    });

    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transactions', 'index')->name('transactions.index');
        Route::get('/transactions/print/{transaction}', 'print')->name('transactions.print');
        Route::post('/transactions', 'store')->name('transactions.store');
    });
});

Route::group(['middleware' => ['role:super-admin|admintoko']], function () {
    Route::get('/dashboardsuperadmin', function () {
        $tokos = Toko::all();

        foreach ($tokos as $toko) {
            $januari = Cart::whereMonth('created_at', '01')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $februari = Cart::whereMonth('created_at', '02')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $maret = Cart::whereMonth('created_at', '03')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $april = Cart::whereMonth('created_at', '04')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $mei = Cart::whereMonth('created_at', '05')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $juni = Cart::whereMonth('created_at', '06')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $july = Cart::whereMonth('created_at', '07')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $agustus = Cart::whereMonth('created_at', '08')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $september = Cart::whereMonth('created_at', '09')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $oktober = Cart::whereMonth('created_at', '10')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $november = Cart::whereMonth('created_at', '11')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');

            $desember = Cart::whereMonth('created_at', '12')->whereYear('created_at', '2023')
                ->where('toko_id', $toko->id)
                ->sum('jumlah');
            $red = rand(100, 225);
            $green = rand(100, 225);
            $blue = rand(100, 225);
            $datasets[] = [
                "backgroundColor" => "rgb($red,$green,$blue)",
                "borderColor" => "rgb($red,$green,$blue)",
                "label" => $toko->name,
                "januari" => $januari,
                "februari" => $februari,
                "maret" => $maret,
                "april" => $april,
                "mei" => $mei,
                "juni" => $juni,
                "july" => $july,
                "agustus" => $agustus,
                "september" => $september,
                "oktober" => $oktober,
                "november" => $november,
                "desember" => $desember
            ];
        }
        return view('adminsuper.dashboard', compact('datasets'));
    })->name('dashboardsuperadmin');

    Route::controller(UsersController::class)->group(function () {
        Route::get('/adminsuper/users', 'index')->name('adminsuper.users.index');
        Route::get('/adminsuper/users/destroy/{id}', 'destroy')->name('adminsuper.users.destroy');
        Route::put('/adminsuper/users/updatepassword/{id}', 'updatepassword')->name('adminsuper.users.updatepassword');
    });

    Route::controller(AdminSuperTransactionController::class)->group(function () {
        Route::get('/adminsuper/transactions', 'index')->name('adminsuper.transactions.index');
        Route::get('/adminsuper/transactions/print', 'print')->name('adminsuper.transactions.print');
    });

    Route::controller(FeaturedProductController::class)->group(function () {
        Route::get('/adminsuper/featured-product', 'index')->name('adminsuper.featured-product.index');
    });


    Route::controller(TokoController::class)->group(function () {
        Route::get('/adminsuper/tokos', 'index')->name('adminsuper.tokos.index');
        Route::get('/adminsuper/tokos/destroy/{toko}', 'destroy')->name('adminsuper.tokos.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/adminsuper/categories', 'index')->name('adminsuper.categories.index');
        Route::put('/adminsuper/categories/{id}', 'update')->name('adminsuper.categories.update');
        Route::post('/adminsuper/categories', 'store')->name('adminsuper.categories.store');
        Route::get('/adminsuper/categories/destroy/{id}', 'destroy')->name('adminsuper.categories.destroy');
    });

    Route::controller(BannerController::class)->group(function () {
        Route::get('/adminsuper/banners', 'index')->name('adminsuper.banners.index');
        Route::post('/adminsuper/banners', 'store')->name('adminsuper.banners.store');
        Route::get('/adminsuper/banners/destroy/{id}', 'destroy')->name('adminsuper.banners.destroy');
    });
});

Route::group(['middleware' => ['role:admintoko']], function () {

    Route::get('/dashboard', function (Request $request) {
        if (!auth()->user()->toko) {
            Alert::info('Toko Belum Ada', 'silakan mengupdate toko terlebih dahulu');
            return view('admintoko.profile.index');
        }

        $transactions = Transaction::where('toko_id', auth()->user()->toko->id ?? 0)->get();

        $toko_id = auth()->user()->toko->id;

        $carts = DB::select("SELECT sum(jumlah) as total,DATE(carts.created_at) AS tanggal FROM carts where carts.toko_id = $toko_id GROUP BY DATE(carts.created_at)");

        if ($request->dari && $request->sampai) {
            $transactions = Transaction::where('created_at', '>=', $request->dari)
                ->where(DB::raw('DATE(created_at)'), '<=', $request->sampai)
                ->where('toko_id', auth()->user()->toko->id ?? 0)
                ->get();
            // $transactions = Transaction::whereBetween('DATE(created_at)', [$request->dari, $request->sampai])->where('toko_id', auth()->user()->toko->id ?? 0)->get();
            $carts = DB::select("SELECT sum(jumlah) as total,DATE(carts.created_at) AS tanggal FROM carts where carts.toko_id = $toko_id  GROUP BY DATE(carts.created_at)");
        }

        $januari = Cart::whereMonth('created_at', '01')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $februari = Cart::whereMonth('created_at', '02')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $maret = Cart::whereMonth('created_at', '03')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $april = Cart::whereMonth('created_at', '04')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $mei = Cart::whereMonth('created_at', '05')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $juni = Cart::whereMonth('created_at', '06')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $july = Cart::whereMonth('created_at', '07')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $agustus = Cart::whereMonth('created_at', '08')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $september = Cart::whereMonth('created_at', '09')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $oktober = Cart::whereMonth('created_at', '10')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $november = Cart::whereMonth('created_at', '11')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $desember = Cart::whereMonth('created_at', '12')->whereYear('created_at', '2023')
            ->where('toko_id', $toko_id)
            ->sum('jumlah');

        $products = Product::with('carts')->get();
        $bulan = null;
        $tahun = null;
        foreach ($products as $product) {
            $tersewa = Cart::where('product_id', $product->id)->where('status', 'checkout');
            if ($request->bulan) {
                $bulan = $request->bulan;
                $tersewa->whereMonth('created_at', $bulan);
            }
            if ($request->tahun) {
                $tahun = $request->tahun;
                $tersewa->whereYear('created_at', $tahun);
            }

            $popularProduct[] = [
                "namaProduk" => $product->name,
                "tersewa" => $tersewa->sum('jumlah')
            ];
        }
        $collectPopularProduct = collect($popularProduct)->sortByDesc('tersewa');

        return view('admintoko.dashboard', compact('transactions', 'carts', 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'july', 'agustus', 'september', 'oktober', 'november', 'desember', 'collectPopularProduct', 'bulan', 'tahun'));
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/admintoko/profile', 'index')->name('admintoko.profile.index');
        Route::patch('/admintoko/profile/{user}', 'update')->name('admintoko.profile.update');
        Route::patch('/admintoko/profile/{user}/toko', 'updatetoko')->name('admintoko.profile.updatetoko');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/admintoko/products', 'index')->name('admintoko.products.index');

        Route::post('/admintoko/products', 'store')->name('admintoko.products.store');
        Route::get('/admintoko/products/create', 'create')->name('admintoko.products.create');
        Route::get('/admintoko/products/{product}', 'destroy')->name('admintoko.products.destroy');
        Route::put('/admintoko/products/{product}', 'update')->name('admintoko.products.update');
    });

    Route::controller(AdminTokoTransactionController::class)->group(function () {
        Route::get('/admintoko/transactions', 'index')->name('admintoko.transactions.index');
        Route::get('/admintoko/transactions/print', 'print')->name('admintoko.transactions.print');
        Route::get('/admintoko/transactions/{id}', 'terima')->name('admintoko.transactions.terima');
        Route::get('/admintoko/transactions/{id}/diterima', 'diterima')->name('admintoko.transactions.diterima');
    });
});


require __DIR__ . '/auth.php';
