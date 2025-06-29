@extends('mainlayout')

@section('content')
<div class="container">
    <h2>{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu' }}</h2>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form untuk menambah atau mengedit menu -->
    <form action="{{ isset($menu) ? route('menu.update', $menu->id) : route('menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($menu))
            @method('PUT') <!-- Jika mengedit, gunakan metode PUT -->
        @endif
        <div class="form-group">
            <label for="nama_menu">Nama Menu:</label>
            <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $menu->harga ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $menu->deskripsi ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label for="gambar">Gambar:</label>
            <input type="file" class="form-control" id="gambar" name="gambar" {{ isset($menu) ? '' : 'required' }}>
            @if(isset($menu))
                <p>Gambar saat ini:</p>
                <img src="{{ asset('images/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($menu) ? 'Update Menu' : 'Tambah Menu' }}</button>
        <div class="mt-3">
        <a href="{{ route('manage.orders') }}" class="btn btn-secondary">Order</a>

</div>
    </form>

    <hr>

    <!-- Daftar menu -->
    <h3>Daftar Menu</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->nama_menu }}</td>
                    <td>${{ $menu->harga }}</td>
                    <td>{{ $menu->deskripsi }}</td>
                    <td><img src="{{ asset('images/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" width="50"></td>
                    <td>
                        <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('menu.delete', $menu->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
