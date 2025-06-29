@extends('mainlayout')

@section('content')
    <!-- Menampilkan notifikasi jika ada session success -->
    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <div class="bg-image" style="background-image: url('{{ asset('images/3.jpeg') }}');">
        <h2>Welcome to Pompom's Coffee!</h2>
        <p>Enjoy the best coffee in town.</p>
    </div>
@endsection
