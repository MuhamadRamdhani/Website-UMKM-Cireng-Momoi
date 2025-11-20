@extends('layouts.base')

@section('content')
<style>
    .single_testimonial {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        height: 100%;
    }
    .testimonial_text p {
        font-style: italic;
        font-size: 16px;
        color: #555;
    }
    .testimonial_text h5 {
        margin-top: 15px;
        font-weight: bold;
        color: #343a40;
    }
</style>

<!-- banner part start -->
<section class="banner_part" style="background-color:rgb(255, 255, 255);">
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Kiri: Teks -->
            <div class="col-lg-6 text-lg-start mb-4 mb-lg-0">
                <h1><strong>Cireng <span style="color: #ff4e50;">MOMOII</span></strong></h1>
                <p class="mt-3">Cemilan legendaris yang renyah di luar, lembut di dalam! Handmade dari bahan premium, bikin nagih di setiap gigitan.</p>
                <p class="mt-2">Temani keseharian anda dengan cemilan dari cireng momoii yang lezat, premium dan harga terjangkau.</p>
                <a href="#" class="btn btn-danger mt-3 px-4 py-2">BUY NOW</a>
            </div>

            <!-- Kanan: Gambar -->
            <div class="col-lg-6 text-center pt-5"> {{-- Tambahkan padding-top di sini --}}
                <div class="position-relative d-inline-block">
                   <img src="{{ url('assets/img/project/cireng6.png') }}" alt="Cireng MOMOII"
     class="img-fluid" style="max-width: 100%; height: auto;">


                    <!-- Badge: harus di dalam elemen position-relative -->
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner part end -->


<!-- product_list part start -->
<section class="product_list best_seller section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Best Products</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap">
                    @foreach($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="single_product_item">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                                <div class="single_product_text">
                                    <h4>{{ $product->name }}</h4>
                                    <h3>Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('detail.products', $product->id) }}" class="btn-sm btn-primary text-white">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_list part end -->

<!-- why us part start -->
<section class="why_us_section py-5 bg-light">
    <div class="container text-center">
        <h2>Kenapa Pilih Cireng MOMOII?</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <i class="fas fa-star fa-2x mb-2 text-warning"></i>
                <h5>Kualitas Premium</h5>
                <p>Terbuat dari bahan pilihan dan diolah secara higienis.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-shipping-fast fa-2x mb-2 text-info"></i>
                <h5>Pengiriman Cepat</h5>
                <p>Diproses dan dikirim dalam waktu 1x24 jam.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-heart fa-2x mb-2 text-danger"></i>
                <h5>Rasa Dijamin Enak</h5>
                <p>Sudah terbukti dari ribuan pelanggan puas.</p>
            </div>
        </div>
    </div>
</section>
<!-- why us part end -->

<!-- testimonial part start -->
<section class="testimonial_part section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Apa Kata Mereka</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Testimoni 1 -->
            <div class="col-md-4">
                <div class="single_testimonial">
                    <div class="testimonial_text text-center">
                        <p>"Cireng MOMOII enak banget! Renyah di luar, lembut di dalam, bumbunya mantap!"</p>
                        <h5>- Rina, Bogor</h5>
                    </div>
                </div>
            </div>
            <!-- Testimoni 2 -->
            <div class="col-md-4">
                <div class="single_testimonial">
                    <div class="testimonial_text text-center">
                        <p>"Aku sudah langganan, cocok banget buat camilan sore hari. Recommended!"</p>
                        <h5>- Andi, Bogor</h5>
                    </div>
                </div>
            </div>
            <!-- Testimoni 3 -->
            <div class="col-md-4">
                <div class="single_testimonial">
                    <div class="testimonial_text text-center">
                        <p>"Pertama kali coba langsung suka! Kemasannya juga rapi dan higienis."</p>
                        <h5>- Sari, Bogor</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- testimonial part end -->
@endsection
