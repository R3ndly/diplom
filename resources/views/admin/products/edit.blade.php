@extends('layouts.app')
@section('title')Редактировать данные товара @endsection
@section('content')

<div class="row text-center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Редактирование записи</h2>
        </div>
    </div>
</div>


<div class="container container__create-form">

<form action="{{ route('admin.products.update',$product->product_id) }}" method="POST">

@csrf
@method('PUT')

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                <input type="text" name="title" value="{{ $product->title }}" class="form-control" placeholder="Название">
            </div>
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Цена:</strong>
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="Цена">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Бренд:</strong>
                <input type="text" name="brand" value="{{ $product->brand }}" class="form-control" placeholder="Бренд">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Доставка:</strong>
                <input type="date" name="delivery" value="{{ $product->delivery }}" class="form-control" placeholder="Доставка">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Категория:</strong>
                <input type="text" name="category" value="{{ $product->category }}" class="form-control" placeholder="Категория">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Гарантия:</strong>
                <input type="text" name="warranty" value="{{ $product->warranty }}" class="form-control" placeholder="Гарантия">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Материал:</strong>
                <input type="text" name="material" value="{{ $product->material }}" class="form-control" placeholder="Материал">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Питание от:</strong>
                <input type="text" name="power_supply" value="{{ $product->power_supply }}" class="form-control" placeholder="Питание от">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Фото:</strong>
                <input type="file" name="product_image" value="{{ $product->product_image }}" class="form-control" placeholder="Фото">
            </div>
        </div> 


    <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
    <button type="submit" class="btn btn-primary">Редактировать</button>
    <a class="btn btn-primary" href="{{route('admin.products.index')}}">Назад</a>
</div>

</div>
</div>
</form>

@endsection