@extends('layouts.base')

@section('content')
  {{-- Tampilan sukses checkout --}}
  <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center">
      <h2>Checkout Berhasil!</h2>
      <p>Terima kasih telah melakukan pembelian. Silakan menunggu konfirmasi dari admin melalui email atau nomor telepon Anda.</p>
      <a href="{{ route('welcome') }}" class="btn_3 mt-3">Kembali ke Beranda</a>
    </div>
  </div>
@endsection
