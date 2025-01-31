@extends('layouts.app')
@section('title') Оформление доставки @endsection
@section('content')
<div class="container">
    <h2>Оформление доставки</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="shipping_address">Адрес доставки:</label>
            <input type="text" id="shipping_address" name="shipping_address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="payment_method">Способ оплаты:</label>
            <select id="payment_method" name="payment_method" class="form-control" required>
                <option value="credit_card">Кредитная карта</option>
                <option value="cash">Наличные</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Подтвердить заказ</button>
    </form>
</div>
@endsection
