@extends('mainlayout')

@section('content')
    <div class="cart-container">
        <h2>Keranjang Belanja Anda</h2>
        <!-- Menampilkan notifikasi jika ada session success -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('cart') && count(session('cart')) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Menu</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart') as $id => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" id="remove-form-{{ $id }}">
                                    @csrf
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $id }})">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>

            <!-- Tombol Pembayaran -->
            <a href="{{ route('menu') }}" class="btn btn-primary">Lanjutkan Belanja</a>
            <a href="{{ route('payment') }}" class="btn btn-success">Proses Pembayaran</a>
        @else
            <p>Keranjang Anda kosong.</p>
            <!-- Tombol Lanjutkan Belanja tetap ada meskipun keranjang kosong -->
            <a href="{{ route('menu') }}" class="btn btn-primary">Lanjutkan Belanja</a>
        @endif
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus menu ini dari keranjang?")) {
                // Jika user mengonfirmasi, kirimkan form penghapusan
                document.getElementById('remove-form-' + id).submit();
            }
        }
    </script>
@endsection
