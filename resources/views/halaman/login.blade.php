@extends('mainlayout')

@section('content')
    <div class="container">
        <h2>Login</h2>


        <!-- Menampilkan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Menampilkan pesan jika akun tidak ditemukan -->
        @if (session('register_message'))
            <div class="alert alert-warning">
                {{ session('register_message') }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- JavaScript untuk redirect -->
    @if (session('redirect_to_register'))
        <script>
            setTimeout(() => {
                window.location.href = "{{ route('register') }}";
            }, 3000); // Tunggu 3 detik sebelum redirect
        </script>
    @endif
@endsection
