<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\Menu; // Model untuk data menu
use App\Models\User; // Model untuk data user
use App\Models\Order; // Model untuk data order
use Illuminate\Support\Facades\Auth; // Untuk autentikasi
use Illuminate\Support\Facades\Hash;

class CoffeeController extends Controller
{
    // Menambahkan metode index()
    public function index()
    {
        return view('halaman.home'); // Ganti 'home' dengan nama view yang sesuai
    }
    // Tampilkan halaman menu
    public function menu()
    {
        $menus = Menu::all(); // Ambil semua data menu
        return view('halaman.menu', compact('menus')); // Tampilkan view menu dengan data
    }

    // Tampilkan halaman contact
    public function contact()
    {
        return view('halaman.contact'); // Tampilkan view contact
    }

    // Simpan data menu baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|max:2048',
        ]);

        $menu = new Menu();
        $menu->nama_menu = $request->nama_menu;
        $menu->harga = $request->harga;
        $menu->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $menu->gambar = $filename;
        }

        $menu->save();

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan!');
    }

    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('halaman.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('menu.edit')->with('success', 'Login berhasil. Selamat datang!');
        }

        return redirect()->route('login')->with('register_message', 'Anda tidak bisa login karena bukan admin.');
    }

    // Tampilkan halaman home setelah login
    public function home()
    {
        return view('halaman.home');
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Tambahkan item ke keranjang
    public function addToCart(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $menu->nama_menu,
                'price' => $menu->harga,
                'quantity' => $quantity
            ];
        }
        // Menghapus keranjang setelah menambahkan item
        session()->forget('cart'); // Menghapus session keranjang

    // Menambahkan pesan sukses
        session()->put('cart', $cart);
        return redirect()->route('menu')->with('success', 'Item telah ditambahkan ke keranjang.');
    }

    // Hapus item dari keranjang
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Item telah dihapus dari keranjang.');
    }

    // Tampilkan halaman cart
    public function viewCart()
    {
        $cart = session()->get('cart');
        $total = 0;

        if ($cart) {
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }

        return view('halaman.cart', compact('cart', 'total'));
    }

    // Tampilkan halaman pembayaran
    public function showPaymentPage()
    {
        $cart = session()->get('cart');
        $total = 0;

        $items = [];
        if ($cart) {
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
                $items[] = $item;
            }
        }

        return view('halaman.payment', compact('total', 'items'));
    }

    // Proses pembayaran
    // Proses pembayaran
    public function processPayment(Request $request)
{
    // Ambil data dari form
    $customerName = $request->input('customer_name');
    $customerEmail = $request->input('customer_email');
    $paymentMethod = $request->input('payment_method');
    $ewalletProvider = $request->input('ewallet_provider'); // jika ada

    // Ambil item dari session
    $items = session('cart', []); 

    // Hitung total harga
    $total = collect($items)->sum(function ($item) {
        return $item['price'] * $item['quantity']; // Total harga per item
    });

    // Jika total kosong, set nilai default 0 (atau validasi lainnya)
    if ($total == 0) {
        $total = 0;
    }

    // Simpan order ke database
    $order = new Order();
    $order->customer_name = $customerName;
    $order->customer_email = $customerEmail;
    $order->total_price = $total;
    $order->payment_method = $paymentMethod;
    $order->ewallet_provider = $ewalletProvider;  // Simpan jika menggunakan e-wallet
    $order->save();


    //Menghapus keranjang setelah menambahkan item
        session()->forget('cart'); // Menghapus session keranjang
    // Menyimpan pesan sukses ke session
    session()->flash('success', 'Pesanan Anda telah berhasil diterima. Terima kasih!');

    // Redirect ke halaman utama (home)
    return redirect()->route('home');  // Pastikan sudah ada route 'home'
}
public function manageOrders()
    {
        // Ambil semua data order dari database
        $orders = Order::all();
        
        // Kirim data order ke view
        return view('halaman.manage', compact('orders'));
    }

    // Menghapus order
    public function deleteOrder($orderId)
    {
        // Hapus order berdasarkan ID
        $order = Order::findOrFail($orderId);
        $order->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('manage.orders')->with('payment_success', 'Order berhasil dihapus');
    }


public function success($orderId)
{
    // Ambil data order berdasarkan ID
    $order = Order::findOrFail($orderId);

    // Pastikan $items adalah array atau objek yang valid
    $items = session('cart_items', []);  // Default value array kosong jika tidak ada dalam session

    // Total harga dari order
    $total = $order->total_price;

    // Kirim data ke view
    return view('halaman.success', compact('order', 'items', 'total'));
}


    


    // Tampilkan halaman receipt
    public function showReceipt($orderId)
    {
        // Ambil data order berdasarkan ID
        $order = Order::findOrFail($orderId);
        $items = $order->items; // Mengambil daftar item dari order
        $total = $order->total_price; // Total harga dari order

        // Kirim data order dan items ke view receipt
        return view('halaman.success', compact('items', 'total'));
    }

    // Edit menu
    public function editMenu($id = null)
    {
        $menus = Menu::all();
        $menu = $id ? Menu::findOrFail($id) : null;

        return view('halaman.editmenu', compact('menus', 'menu'));
    }

    // Hapus menu
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan');
        }

        $menu->delete();

        return redirect()->route('menu.edit')->with('success', 'Menu berhasil dihapus');
    }

    // Perbarui menu
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        $menu = Menu::findOrFail($id);

        $menu->nama_menu = $request->nama_menu;
        $menu->harga = $request->harga;
        $menu->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $menu->gambar = $filename;
        }

        $menu->save();

        return redirect()->route('menu.edit')->with('success', 'Menu berhasil diperbarui.');
    }
    public function manage()
{
    // Ambil data yang dibutuhkan untuk halaman manage, jika ada
    return view('halaman.manage'); // Pastikan file `manage.blade.php` ada di folder `resources/views`
}

}
