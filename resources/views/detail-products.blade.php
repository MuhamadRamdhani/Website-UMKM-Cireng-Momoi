@extends('layouts.base')

@section('content')
    <!-- breadcrumb start-->
    <section class="breadcrumb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Product Details</h2>
                            <p>Home <span>-</span> Shop Product Details</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Single Product Area =================-->
    {{-- Nampilin data di detail product --}}
    <div class="product_image_area section_padding">
        <div class="container">
            <div class="row s_product_inner justify-content-between">
                <div class="col-lg-7 col-xl-7">
                    <div class="product_slider_img">
                        <div id="vertical">
                            <!-- Thumbnail utama -->
                            <div data-thumb="{{ $product->thumbnail ? asset('storage/'.$product->thumbnail) : asset('assets/img/project/cireng1.jpeg') }}">
                                <img src="{{ $product->thumbnail ? asset('storage/'.$product->thumbnail) : asset('assets/img/project/cireng1.jpeg') }}" alt="{{ $product->name }}" width="500" />
                            </div>
                            
                            <!-- Gambar tambahan dari product_images -->
                            @foreach($product->images as $image)
                                <div data-thumb="{{ asset('storage/'.$image->image_path) }}">
                                    <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $product->name }} - Image {{ $loop->iteration + 1 }}" width="500"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4">
                    <div class="s_product_text">
                        <h3>{{ $product->name }}</h3>
                        <h2>Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                        <ul class="list">
                            <li>
                                <a class="active" href="#">
                                    <span>Stok</span> : {{ $product->stock }} pack
                                </a>
                            </li>
                        </ul>
                        <p>{{ $product->description }}</p>
                        <div class="card_area d-flex justify-content-between align-items-center">
                          @auth
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                              <input type="hidden" name="quantity" value="1">
                              <button type="submit" class="btn_3">Add to Cart</button>
                            </form>
                            @else
                               <input class="input-number quantity-input" 
                                    type="hidden" 
                                    name="quantity" 
                                    value="1" 
                                    min="1" 
                                    max="{{ $product->stock }}">
                            <a href="{{ url('/login') }}" class="btn_3">Add to Cart</a>
                        @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->
@endsection