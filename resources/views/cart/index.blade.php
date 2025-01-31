@extends('layouts.app')
@section('title') Ваша корзина товаров @endsection
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center oformit">
        <h2>Корзина на {{ $total }} ₽ </h2>
        <form method="GET" action="{{ route('orders.create') }}" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-primary">Оформить доставку</button>
        </form>
    </div>
</div>

<div class="container">
    <table class="table table-striped">
        @foreach($cartItems as $item)
        <tr>
            <td><img src="{{ $item->product->product_image }}" class="cart" style="max-width: 100px; height: auto;" alt="{{ $item->product->title }}"></td>
            <td>{{ $item->product->title }}</td>
            <td>{{ $item->product->price }} Рублей</td>
            <td>{{ $item->quantity }} шт.</td>
            <td>{{ $item->quantity * $item->product->price }} Рублей</td>
            <td>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ydalit"></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
