@extends('layouts.app')
@section('title') Оформление доставки @endsection
@section('content')
<div class="container delivery-block" style="flex-direction: column;">
    <div class="card-1 shadow p-4 login__form delivery-card">
        <h2>Оформление доставки</h2><br>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="shipping_address">Адрес доставки:</label>
                <input type="text" id="shipping_address" name="shipping_address" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Способ оплаты:</label>
                <select id="payment_method" name="payment_method" class="form-control" required>
                    <option value="WebMoney">WebMoney</option>
                    <option value="SBP">СБП</option>
                    <option value="Kiwi">Kiwi</option>
                </select>
            </div><br>

            <button type="submit" class="btn btn-primary mx-auto">Подтвердить</button>

        </form>
    </div>
</div>
@endsection
