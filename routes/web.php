<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;
use App\Models\ProductName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Category;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserManagementController;
use App\Models\User;


Route::middleware('web')->group(function () {
    Route::get('/lang/{locale}', function ($locale) {
        if (!in_array($locale, ['en', 'lv'])) {
            abort(400);
        }
        Session::put('locale', $locale);
        return redirect()->back();
    })->name('lang.switch');

    Route::middleware(['role:admin,manager'])->group(function () {
        Route::get('/user-management', [UserManagementController::class, 'index'])->name('user.management');
        Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user.management.create');
        Route::post('/user-management/store', [UserManagementController::class, 'store'])->name('user.management.store');
        Route::patch('/user-management/{user}/block', [UserManagementController::class, 'toggleBlock'])->name('user.management.block');
        Route::delete('/user-management/{user}', [UserManagementController::class, 'destroy'])->name('user.management.delete');
        Route::get('/user-management/{user}/edit', [UserManagementController::class, 'edit'])->name('user.management.edit');
        Route::patch('/user-management/{user}', [UserManagementController::class, 'update'])->name('user.management.update');
    });

    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/products', function () {
        return view('products');
    })->name('products');

    Route::get('/map', function () {
        // Fetch any data you need for the tables view, for example:
        $orders = DB::table('orders')
            ->join('tables', 'orders.table_id', '=', 'tables.id')
            ->select('orders.id', 'orders.table_id', 'tables.id as table_name', 'orders.created_at')
            ->whereNull('orders.fulfilled_at')
            ->orderBy('orders.created_at', 'asc')
            ->get();

        return view('tables', compact('orders'));
    });

    Route::middleware('auth')->get('/orderHistory', [OrderController::class, 'orderHistory'])->name('orderHistory');

    Route::get('/menu', [MenuController::class, 'search'])->name('menu');

    Route::get('/product/{id}', function ($id) {
            return view('products', ['id' => $id]);
        })->name('product.show');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::post('/cart/add/{id}', function(Request $request, $id) {
        $amount = (int) $request->input('amount', 1);
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            $cart[$id] += $amount;
        } else {
            $cart[$id] = $amount;
        }
    
        session(['cart' => $cart]);
    
        return redirect()->back()->with('success', 'Added to cart!');
    })->name('cart.add');

    Route::get('/cart', function () {
        $cart = session('cart', []);
        $products = [];

        foreach ($cart as $id => $amount) {
            $product = Product::find($id);
            $product_name = ProductName::where('product_id', $id)->first();
            if ($product && $product_name) {
                $products[] = [
                    'id' => $id,
                    'name' => $product_name->product_name,
                    'amount' => $amount,
                    'price' => $product->product_price,
                    'total' => $product->product_price * $amount,
                ];
            }
        }

        return view('cart', compact('products'));
    })->name('cart.view');

    Route::post('/cart/pay', function (\Illuminate\Http\Request $request) {
        $tableId = $request->input('table_number'); // Actually table_id now
        $cart = session('cart', []);
        if(Auth::check()){
            $userId = Auth::id();
        }
        else{
            $userId = null;
        }

        // 1. Create the order
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $userId,
            'table_id' => $tableId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Link products to the order
        foreach ($cart as $productId => $amount) {
            DB::table('order_product_link')->insert([
                'order_id' => $orderId,
                'product_id' => $productId,
                'amount' => $amount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        session()->forget('cart');
        return redirect()->route('cart.view')->with('success', "Order placed for table $tableId! Thank you.");
    })->name('cart.pay');

    Route::get('/orders', function () {
        $orders = DB::table('orders')
            ->join('tables', 'orders.table_id', '=', 'tables.id')
            ->select(
                'orders.id',
                'orders.table_id',
                'tables.id as table_name',
                'orders.created_at',
                'orders.status' // <-- Make sure this is here!
            )
            ->whereNull('orders.fulfilled_at')
            ->orderBy('orders.created_at', 'asc')
            ->get();

        return view('tables', compact('orders'));
    })->name('orders');

    Route::post('/orders/fulfill/{id}', function ($id) {
        DB::table('orders')->where('id', $id)->update(['fulfilled_at' => now()]);
        return redirect()->route('tables.view')->with('success', 'Order marked as fulfilled!');
    })->name('orders.fulfill');

    Route::get('/all-orders', function () {
        return redirect()->route('tables.view');
    })->name('all.orders');

    Route::get('/tables', function () {
        $locale = app()->getLocale();

        $orders = DB::table('orders')
            ->join('tables', 'orders.table_id', '=', 'tables.id')
            ->select(
                'orders.id',
                'orders.table_id',
                'tables.id as table_name',
                'orders.created_at',
                'orders.status' // Ensure this is included
            )
            ->whereNull('orders.fulfilled_at')
            ->orderBy('orders.created_at', 'asc')
            ->get();

        return view('tables', compact('orders'));
    })->name('tables.view');
    Route::get('/orders/{id}/details', function ($id) {
        $locale = app()->getLocale();
        
        $items = DB::table('order_product_link')
            ->join('product_names', 'order_product_link.product_id', '=', 'product_names.product_id')
            ->where('order_product_link.order_id', $id)
            ->where('product_names.locale', '=', $locale)
            ->select('product_names.product_name', 'order_product_link.amount')
            ->get();

        return view('order-details', ['items' => $items, 'orderId' => $id]);
    })->name('order.details');

    Route::get('/menu-item/create', function () {
        $categories = Category::all();
        return view('menu-item-create', compact('categories'));
    })->name('menuitem.create');

    Route::post('/menu-item/store', function (Request $request) {
        $request->validate([
            'product_name_en' => 'required|string|max:255',
            'product_name_lv' => 'nullable|string|max:255',
            'product_description_en' => 'nullable|string',
            'product_description_lv' => 'nullable|string',
            'product_price' => 'required|numeric',
            'product_img' => 'nullable|image',
            'product_category' => 'required|exists:categories,id',
        ]);

        // Store product
        $product = Product::create([
            'product_price' => $request->product_price,
            'product_img' => $request->file('product_img') ? $request->file('product_img')->store('img', 'public') : null,
            'product_category' => $request->product_category,
        ]);

        // Store product names (en and optionally lv)
        ProductName::create([
            'product_id' => $product->id,
            'product_name' => $request->product_name_en,
            'product_description' => $request->product_description_en,
            'locale' => 'en',
        ]);
        if ($request->product_name_lv) {
            ProductName::create([
                'product_id' => $product->id,
                'product_name' => $request->product_name_lv,
                'product_description' => $request->product_description_lv,
                'locale' => 'lv',
            ]);
        }

        return redirect()->route('menuitem.create')->with('success', 'Menu item created!');
    })->name('menuitem.store');

    Route::post('/users/roles/update', function (Request $request) {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'role' => 'required|string',
    ]);
    $user = User::find($request->user_id);
    $user->role = $request->role;
    $user->save();
    return redirect()->back()->with('success', 'User role updated!');
})->name('users.roles.update');

    Route::delete('/users/{id}/delete', function ($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted!');
    })->name('users.delete');

    Route::post('/orders/{id}/status', function (Request $request, $id) {
        $request->validate([
            'status' => 'required|in:cooking,cooked,finished',
        ]);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', 'Order status updated!');
    })->name('orders.status.update');
});