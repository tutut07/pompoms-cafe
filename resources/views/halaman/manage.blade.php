@extends('mainlayout')

@section('content')
    <div class="container">
        <h4>Daftar Order</h4>
        <div class="mt-3">
        <a href="{{ route('menu.edit') }}" class="btn btn-secondary">Menu</a>

</div>
        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('payment_success'))
            <div class="alert alert-success" role="alert">
                {{ session('payment_success') }}
            </div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID Order</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Email</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Metode Pembayaran</th>
                    <th scope="col">Tanggal Pembayaran</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <!-- Hapus order -->
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
