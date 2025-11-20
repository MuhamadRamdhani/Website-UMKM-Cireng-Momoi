@extends('layouts.base')

@section('content')
<style>
/* Hilangkan panah atas bawah di input number */
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}
</style>

<!-- breadcrumb start-->
<section class="breadcrumb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Cart</h2>
                        <p>Home <span>-</span>Cart</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--================Cart Area =================-->

{{-- Nampilin data cart barang yang di beli atau dipesan customer --}}
<section class="cart_area padding_top">
    <div class="container">
        <div class="cart_inner">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cart->items as $item)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="{{ $item->product->thumbnail ? asset('storage/'.$item->product->thumbnail) : asset('assets/img/project/cireng1.jpeg') }}" alt="" width="50"/>
                                    </div>
                                    <div class="media-body">
                                        <p>{{ $item->product->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>Rp {{ number_format($item->price, 0, ',', '.') }}</h5>
                            </td>
                          <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                @method('PUT')

                                <div class="d-flex align-items-center border rounded overflow-hidden">
                                    <button type="button" class="btn btn-light px-2" onclick="decrementQuantity(this)">
                                        <i class="ti-angle-down"></i>
                                    </button>

                                    <input type="number" name="quantity"
                                          value="{{ $item->quantity }}"
                                          min="1" max="{{ $item->product->stock }}"
                                          class="form-control text-center border-0"
                                          style="width: 60px; box-shadow: none;">

                                    <button type="button" class="btn btn-light px-2" onclick="incrementQuantity(this)">
                                        <i class="ti-angle-up"></i>
                                    </button>
                                </div>

                                <button type="submit" class="btn btn-sm btn-secondary ml-3 px-2">Update</button>
                            </form>
                        </td>


                            <td>
                                <h5>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</h5>
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Your cart is empty</td>
                        </tr>
                        @endforelse
                        <tr class="bottom_button">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>Rp {{ number_format($cart->total_price ?? 0, 0, ',', '.') }}</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @if($cart->items->isNotEmpty())
                <div class="checkout_btn_inner float-right">
                    <a class="btn_1" href="{{ route('welcome') }}">Continue Shopping</a>
                    <a class="btn_1 checkout_btn_1" href="{{route('checkout.index')}}">Proceed to checkout</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

{{-- Javascript untuk logic tambah kurang quantity barang atau pesanan --}}
<script>
function incrementQuantity(button) {
    const input = button.closest('form').querySelector('input[name="quantity"]');
    const max = parseInt(input.max);
    let value = parseInt(input.value);
    if (value < max) {
        input.value = value + 1;
    }
}

function decrementQuantity(button) {
    const input = button.closest('form').querySelector('input[name="quantity"]');
    const min = parseInt(input.min);
    let value = parseInt(input.value);
    if (value > min) {
        input.value = value - 1;
    }
}
</script>

@endsection