<?php
// Model Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'payment_method',
    ];

    public function store(Request $request)
{
    // Simpan data order ke database
    $order = new Order();
    $order->customer_name = $request->input('customer_name');
    $order->customer_email = $request->input('customer_email');
    $order->total_price = $request->input('total_price');
    $order->payment_method = $request->input('payment_method');
    $order->ewallet_provider = $request->input('ewallet_provider');
    $order->save();

    // Redirect ke halaman success dengan orderId
    return redirect()->route('payment.success', ['orderId' => $order->id]);
}
}
