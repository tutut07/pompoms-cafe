@extends('mainlayout')

@section('content')
<div class="container">
    <h4>Daftar Item yang Dibeli:</h4>
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
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total Pembayaran</strong></td>
                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <h4>Pilih Metode Pembayaran:</h4>
    <form action="{{ route('payment.submit') }}" method="POST" style="max-width: 500px; margin: auto;">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="customer_name" style="display: block;">Nama Lengkap:</label>
            <input type="text" id="customer_name" name="customer_name" required style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="customer_email" style="display: block;">Email:</label>
            <input type="email" id="customer_email" name="customer_email" required style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="payment_method" style="display: block;">Metode Pembayaran:</label>
            <select id="payment_method" name="payment_method" required style="width: 100%; padding: 8px;">
                <option value="credit_card">Kartu Kredit</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>
        <div id="ewallet_details" style="margin-bottom: 15px; display: none;">
            <label for="ewallet_provider" style="display: block;">Penyedia E-Wallet:</label>
            <input type="text" id="ewallet_provider" name="ewallet_provider" style="width: 100%; padding: 8px;">
        </div>
        <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; cursor: pointer;">Bayar</button>
    </form>
</div>

<script>
    // Menampilkan detail e-wallet saat opsi e-wallet dipilih
    document.getElementById('payment_method').addEventListener('change', function() {
        var ewalletDetails = document.getElementById('ewallet_details');
        if (this.value === 'ewallet') {
            ewalletDetails.style.display = 'block';
        } else {
            ewalletDetails.style.display = 'none';
        }
    });
</script>
@endsection
