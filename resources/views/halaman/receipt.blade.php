@extends('mainlayout')

@section('content')
<div class="container">
    <h3>Receipt Pembayaran</h3>

    <h4>Detail Pesanan:</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Menu</th>
                <th scope="col">Harga</th>
                <th scope="col">Kuantitas</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Pembayaran -->
    <h4>Total Pembayaran: Rp {{ number_format($total, 0, ',', '.') }}</h4>

    <h4>Metode Pembayaran: {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</h4>

    <!-- Tombol untuk kembali ke menu utama -->
    <a href="{{ route('menu') }}" class="btn btn-primary">Kembali ke Menu</a>
</div>
@endsection
