@extends('customer.layout.app')
@section('title','Sản phẩm')
@section('name','Sản phẩm')

@section('content')


<section class="product-header text-center">
    <div class="container">
        <h2 class="section-title">{{ strtoupper($title) }}</h2>
    </div>
</section>
<section id="filter-bar">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <!-- Category -->
            <div class="filter-group">
                <span>Category:</span>
                <button class="filter-btn active">All</button>
                <button class="filter-btn">T-shirt</button>
                <button class="filter-btn">Jeans</button>
                <button class="filter-btn">Coat</button>
            </div>
                <!-- Size -->
            <div class="filter-group">
                <span>Size:</span>
                <button class="filter-btn">S</button>
                <button class="filter-btn">M</button>
                <button class="filter-btn">L</button>
                <button class="filter-btn">XL</button>
            </div>
                <!-- Sort -->
            <div>
                <select class="form-select">
                    <option>Sort by</option>
                    <option>Price low → high</option>
                    <option>Price high → low</option>
                </select>
            </div>
        </div>
    </div>
</section>
    <!-- PRODUCTS -->
<section id="product-page">
    <div class="container">
        <div class="row" id="n-product">
            <div class="col-lg-3">
                <div class="bg-gray">
                    <a href="{{ route('customer.product.detail', 1) }}"><img src="{{ asset('images/ao.jpg') }}" alt=""></a>
                </div>
                <h3><a href="{{ route('customer.product.detail', 1) }}">Acid Wash Logo T-shirt</a></h3>
                <span class="price">229.000₫</span>
            </div>
            <div class="col-lg-3">
                <div class="bg-gray">
                    <a href="{{ route('customer.product.detail', 1) }}"><img src="{{ asset('images/ao2.jpg') }}" alt=""></a>
                </div>
                <h3><a href="{{ route('customer.product.detail', 1) }}">Relaxed Heavy Jersey T-shirt</a></h3>
                <span class="price">229.000₫</span>
            </div>
            <div class="col-lg-3">
                <div class="bg-gray">
                    <a href="{{ route('customer.product.detail', 1) }}"><img src="{{ asset('images/quan.jpg') }}" alt=""></a>
                </div>
                <h3><a href="{{ route('customer.product.detail', 1) }}">Slim Jeans</a></h3>
                <span class="price">229.000₫</span>
            </div>
            <div class="col-lg-3">
                <div class="bg-gray">
                    <a href="{{ route('customer.product.detail', 1) }}"><img src="{{ asset('images/quan1.jpg') }}" alt=""></a>
                </div>
                <h3><a href="{{ route('customer.product.detail', 1) }}">Slim Jeans</a></h3>
                <span class="price">229.000₫</span>
            </div>
        </div> 
    </div>
</section>

@endsection