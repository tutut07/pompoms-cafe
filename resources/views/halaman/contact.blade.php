@extends('mainlayout')

@section('content')
    <div class="container contact-container my-5">
        <h1 class="text-center mb-4">Hubungi Kami</h1>

        <!-- Tampilkan pesan sukses atau error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <!-- Informasi Kontak -->
            <div class="col-md-6">
                <h3>Informasi Kontak</h3>
                <p>Jika Anda mempunyai pertanyaan atau kekhawatiran, hubungi kami melalui:</p>
                <ul class="list-unstyled">
                    <li><strong>Telepon:</strong> 0812-1111-8456</li>
                    <li><strong>Email:</strong> <a href="mailto:hello@fore.coffee">hello@fore.coffee</a></li>
                    <li><strong>Alamat:</strong> Gedung Graha Ganesha, Lantai 1 Suite 120 & 130, Jl. Hayam Wuruk No. 28, Jakarta Pusat, DKI Jakarta</li>
                </ul>
            </div>

            <!-- Formulir Kontak -->
            <div class="col-md-6">
                <form action="{{ route('halaman.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Pesan Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
