@extends('layouts.app')
@section('styles')
    @vite(['resources/css/products.css'])
@endsection
@section('title') Добавление аксессуара @endsection
@section('content')

<div class="row text-center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Добавить аксессуар</h2>
        </div>
    </div>
</div>

<div class="container container__create-form">
    <form id="createProductForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Название:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Название" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Цена:</strong>
                    <input type="number" name="price" class="form-control" placeholder="Цена" required min="0">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Бренд:</strong>
                    <input type="text" name="brand" class="form-control" placeholder="Бренд" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Доставка:</strong>
                    <input type="date" name="delivery" class="form-control" placeholder="Доставка" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Категория:</strong>
                    <input type="text" name="category" class="form-control" placeholder="Категория" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Гарантия:</strong>
                    <input type="text" name="warranty" class="form-control" placeholder="Гарантия" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Материал:</strong>
                    <input type="text" name="material" class="form-control" placeholder="Материал" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Питание от:</strong>
                    <input type="text" name="power_supply" class="form-control" placeholder="Питание от" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Фото:</strong>
                    <input type="file" name="product_image" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
                <button type="submit" class="btn btn-primary">Добавить</button>
                <a class="btn btn-primary" href="{{ route('admin.products.index') }}">Назад</a>
            </div>
        </div>
    </form>
</div>

<script>
document.getElementById('createProductForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const token = document.querySelector('meta[name="csrf-token"]').content;

    try {
        const response = await fetch('/api/products', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: formData
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Ошибка при добавлении товара');
        }

        // Перенаправление после успешного добавления
        window.location.href = "{{ route('admin.products.index') }}";

    } catch (error) {
        console.error('Ошибка:', error);
        alert(error.message);
    }
});
</script>
@endsection
