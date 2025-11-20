@extends('layouts.base')

@section('content')
    <!-- breadcrumb start-->
    <section class="breadcrumb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Checkout</h2>
                            <p>Home <span>-</span>Checkout</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->
  <!--================Checkout Area =================-->
  <section class="checkout_area padding_top">
    <div class="container">
      <div class="billing_details">
        <div class="row">
          {{-- Form Checkout Customer --}}
          <div class="col-lg-6">
            <h3>Billing Details</h3>
            <form class="row contact_form" action="{{ route('checkout.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 form-group p_star">
              <label for="name" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" readonly />
            </div>
            <div class="col-md-6 form-group p_star">
              <label for="phone_number" class="form-label">No Telepon / WA</label>
              <input type="tel" class="form-control" name="phone_number" pattern="[0-9]+" title="Hanya boleh angka" required placeholder="085-xxx-xxx"/>
            </div>
            <div class="col-md-6 form-group p_star">
              <label for="email" class="form-label">Alamat Email</label>
              <input type="text" class="form-control" name="email" value="{{ auth()->user()->email }}" readonly />
            </div>
            <div class="col-md-6 form-group p_star">
              <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
              <input type="file" class="form-control" name="payment_proof" required />
              <small class="text-muted">Hanya JPG, JPEG, PNG. Maksimal ukuran 2MB.</small>
            </div>

            <div class="col-md-12 form-group">
              <label for="address" class="form-label">Alamat Lengkap</label>
              <textarea class="form-control" name="address" rows="2" placeholder="Jl Tarumanegara xxxxx" required></textarea>
            </div>

            <div class="col-md-12 form-group mt-3 d-flex justify-content-end">
              <button type="submit" class="btn_3">Checkout Now</button>
            </div>
          </form>
          </div>
          {{-- Detail Pesanan Customer --}}
          <div class="col-lg-6">
            <div class="order_box">
              <h2>Your Order</h2>
             <ul class="list">
                <li>
                  <a href="#">Product <span>Total</span></a>
                </li>
                @foreach($cartItems as $item)
                  <li>
                    <a href="#">
                      {{ $item->product->name }}
                      <span class="middle">x {{ $item->quantity }}</span>
                      <span class="last">Rp {{ number_format($item->product->price * $item->quantity, 2) }}</span>
                    </a>
                  </li>
                @endforeach
              </ul>

              <ul class="list list_2">
                <li>
                  <a href="#">Subtotal
                    <span>Rp {{ number_format($subtotal, 2) }}</span>
                  </a>
                </li>
                <li>
                  <a href="#">Ongkos Kirim
                    <span>Rp 15,000.00</span>
                  </a>
                </li>
                <li>
                  <a href="#">Total
                    <span>Rp {{ number_format($subtotal + 15000, 2) }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->

  {{-- javascipt untuk input no telepon hanya angka string gak bisa --}}
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const phoneInput = document.querySelector('input[name="phone_number"]');
        phoneInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
  </script>
@endsection 