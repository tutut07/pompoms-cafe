@extends('mainlayout')

@section('content')
    <!-- Konten Halaman About Us -->
    <section class="about-us py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="about-title">About Pompom's Coffee</h2>
                    <p>
                        Welcome to our Pompom's Coffee, where we serve the best coffee made with love and passion. Our mission is to create a space where people can enjoy high-quality coffee and pastries while relaxing in a cozy and welcoming environment.
                    </p>
                    <p>
                        We take pride in sourcing the finest coffee beans from around the world and brewing each cup to perfection. Whether you prefer a classic espresso, a frothy cappuccino, or a refreshing iced coffee, we have something for every taste.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="images/2.jpg" alt="About Us Image" class="img-fluid rounded">
                </div>
            </div>

            <div class="social-icons">
                <a href="https://www.instagram.com/pompomchocobi/profilecard/?igsh=MWRyYXM4em1tc25naA==" target="_blank" class="social-icon instagram">
                    <img src="images/ig.jpg" alt="Instagram">
                </a>
                <a href="https://www.tiktok.com/@yourneptun?_t=8rYmwQVEmZR&_r=1" target="_blank" class="social-icon tiktok">
                    <img src="/images/tt.png" alt="Tiktok">
                </a>
                <a href="https://maps.google.com/maps/place//data=!4m2!3m1!1s0x2e7a1713563daccb:0x14e8738f14914297?entry=s&sa=X&ved=1t:8290&hl=id-us&ictx=111" target="_blank" class="social-icon maps">
                    <img src="/images/maps.jpg" alt="Maps">
                </a>
            </div>
        </div>
    </section>
@endsection
