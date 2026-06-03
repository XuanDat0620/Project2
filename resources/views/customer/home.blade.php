@extends('customer.layout.app')
@section('title','Trang chủ')
@section('name','Trang chủ')

@section('content')

<section id="home-banner">
    <div class="slider"> 
        <div class="slides">
            @foreach($sliders as $index => $img)
                <img src="{{ asset('images/' . $img) }}" 
                    class="slide {{ $index == 0 ? 'active' : '' }}">
            @endforeach
        </div>
        <!-- nút -->
        <button class="nav prev">&#10094;</button>
        <button class="nav next">&#10095;</button>
        <!-- dots -->
        <div class="dots">
            @foreach($sliders as $index => $img)
                <span class="dot {{ $index == 0 ? 'active' : '' }}"></span>
            @endforeach
        </div>
    </div>
</section>
    <section id="section-main-2">
        <div class="container text-center">
            <h2 class="section-title">THỜI TRANG MỚI NHẤT</h2>
            <div class="row" id="st2-product">
                @foreach($newProducts as $product)
                    @php
                        $variant = $product->variants->first();
                    @endphp

                    @if($variant)
                    <div class="col-lg-3">
                        <div class="bg-gray">
                            <a href="{{ route('customer.product.detail', $product->p_id) }}">
                                <img src="{{ asset('storage/' . ($variant->pv_image ?? $product->p_image)) }}">
                            </a>
                        </div>

                        <h3>
                            <a href="{{ route('customer.product.detail', $product->p_id) }}">
                                {{ $product->p_name }}
                            </a>
                        </h3>

                        <span class="price">
                            {{ number_format($variant->pv_price, 0, ',', '.') }}₫
                        </span>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="mt-4">
                <a href="{{ route('customer.products') }}" class="btn btn-outline-dark btn-view-more">
                    Xem thêm
                </a>
            </div>
        </div>
    </section>
    <section id="section-main-3">
        <div class="container text-center">
            <h3>SEASON SALE</h3>
            <h2>UP TO 70% OFF</h2>
        </div>
    </section>
    <section id="section-main-4">
        <div class="container text-center">
            <h2 class="section-title">THỜI TRANG BÁN CHẠY NHẤT</h2>
            <div class="row" id="st3-product">
                @foreach($bestProducts as $product)
                    @php
                        $variant = $product->variants->first();
                    @endphp

                    @if($variant)
                    <div class="col-lg-3">
                        <div class="bg-gray">
                            <a href="{{ route('customer.product.detail', $product->p_id) }}">
                                <img src="{{ asset('storage/' . ($variant->pv_image ?? $product->p_image)) }}">
                            </a>
                        </div>

                        <h3>
                            <a href="{{ route('customer.product.detail', $product->p_id) }}">
                                {{ $product->p_name }}
                            </a>
                        </h3>

                        <span class="price">
                            {{ number_format($variant->pv_price, 0, ',', '.') }}₫
                        </span>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="mt-4">
                <a href="{{ route('customer.products') }}" class="btn btn-outline-dark btn-view-more">
                    Xem thêm
                </a>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    let slides = document.querySelectorAll(".slide");
    let dots = document.querySelectorAll(".dot");
    let current = 0;
    let interval = setInterval(nextSlide, 4000);

    function showSlide(index) {
        slides.forEach((s, i) => {
            s.classList.remove("active");
            dots[i].classList.remove("active");
        });

        slides[index].classList.add("active");
        dots[index].classList.add("active");
        current = index;
    }

    function nextSlide() {
        let next = (current + 1) % slides.length;
        showSlide(next);
    }

    function prevSlide() {
        let prev = (current - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    document.querySelector(".next").onclick = nextSlide;
    document.querySelector(".prev").onclick = prevSlide;

    dots.forEach((dot, index) => {
        dot.onclick = () => showSlide(index);
    });

    let slider = document.querySelector(".slider");

    slider.addEventListener("mouseenter", () => clearInterval(interval));
    slider.addEventListener("mouseleave", () => {
        interval = setInterval(nextSlide, 4000);
    });

});
</script>
@endsection