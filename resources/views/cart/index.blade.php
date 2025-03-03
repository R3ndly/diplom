@extends('layouts.app')
@section('title') Ваша корзина товаров @endsection
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center oformit">
        <h2>Корзина на {{ $total }} ₽ </h2>

        @if($cartItems->isNotEmpty())
        <form method="GET" action="{{ route('orders.create') }}" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-primary">Оформить доставку</button>
        </form>
        @endif
    </div>
</div>

<div class="container">
    <div class="blok">
        @foreach($cartItems as $item)
            <div class="block_product">
                <div class="cart_img">
                    <img src="{{ $item->product->product_image }}" class="cart" style="height: 200px;" alt="{{ $item->product->title }}">
                </div>
                <div class="cart_specifications">
                    <div class="cart_title">
                        <h3>{{ $item->product->title }}<h3>
                    </div>
                    <div class="cart_description">
                        <div>
                            <p>Количество: {{ $item->quantity }} шт.</p>
                            <p>Стоимость: {{ $item->quantity * $item->product->price }} руб.</p>
                            <p>Гарантия на {{ $item->product->warranty }}</p>
                        </div>
                        <div>
                            <p>Производитель: {{ $item->product->brand }}</p>
                            <p>Материал: {{ $item->product->material }}</p>
                            <p>Питание от {{ $item->product->power_supply }}</p>
                        </div>
                    </div>
                </div>
                <div class="action_buttons">
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="ydalit"></button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
