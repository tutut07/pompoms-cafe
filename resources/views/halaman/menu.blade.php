@extends('mainlayout')

@section('content')
    <div class="menu-container text-center">
        
        <h2 class="d-inline">Menu Kami</h2>
        <a href="{{ route('cart.view') }}" class="btn btn-secondary btn-view-cart">Cart</a>
        <p>Jelajahi pilihan kopi dan camilan lezat kami.</p>

        <div class="row justify-content-center">
            @foreach($menus as $menu)
                <div class="col-lg-3 col-md-4 col-sm-6 m-3">
                    <div class="card">
                        <img src="{{ asset('images/' . $menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama_menu }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                            <p class="card-text">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                            <p class="card-text">{{ $menu->deskripsi }}</p>

                            <!-- Form untuk menambahkan menu ke keranjang -->
                            <form action="{{ route('cart.add', $menu->id) }}" method="POST" onsubmit="return validateQuantity({{ $menu->id }})">
                                @csrf
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity({{ $menu->id }})" aria-label="Kurangi jumlah">-</button>
                                    <input type="number" id="quantity-{{ $menu->id }}" name="quantity" value="1" min="1" class="form-control text-center quantity-input" oninput="toggleButtons({{ $menu->id }})">
                                    <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity({{ $menu->id }})" aria-label="Tambah jumlah">+</button>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambahkan ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function increaseQuantity(menuId) {
            let quantityInput = document.getElementById('quantity-' + menuId);
            quantityInput.value = parseInt(quantityInput.value) + 1;
            toggleButtons(menuId);
        }

        function decreaseQuantity(menuId) {
            let quantityInput = document.getElementById('quantity-' + menuId);
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
            toggleButtons(menuId);
        }

        function toggleButtons(menuId) {
            let quantityInput = document.getElementById('quantity-' + menuId);
            let decreaseButton = document.querySelector(`#quantity-${menuId} ~ button[onclick^="decreaseQuantity"]`);
            if (parseInt(quantityInput.value) <= 1) {
                decreaseButton.setAttribute('disabled', 'disabled');
            } else {
                decreaseButton.removeAttribute('disabled');
            }
        }

        function validateQuantity(menuId) {
            let quantityInput = document.getElementById('quantity-' + menuId);
            let quantity = parseInt(quantityInput.value);
            if (isNaN(quantity) || quantity <= 0) {
                quantityInput.value = 1; // Set ke 1 jika 0 atau bukan angka
            }
            return true; // Mengizinkan form untuk disubmit
        }
    </script>
@endsection
