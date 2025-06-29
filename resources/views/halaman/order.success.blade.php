<!-- resources/views/order/success.blade.php -->
@extends('mainlayout')

@section('content')
    <h1>Order Successful!</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Total Price: ${{ $order->total_price }}</p>
    <p>Payment Method: {{ $order->payment_method }}</p>
    <p>E-wallet Provider: {{ $order->ewallet_provider }}</p>
    <!-- Tampilkan informasi lain yang diperlukan -->
@endsection
