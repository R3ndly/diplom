@extends('layouts.app')
@section('title') Добавление аксесуара @endsection
@section('content')

<div class="row text-center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Добавить аксесуар</h2>
        </div>
    </div>
</div>

<div class="container container__create-form">

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    
@csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                <input type="text" name="title" class="form-control" placeholder="Название">
            </div>
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Цена:</strong>
                <input type="text" name="price" class="form-control" placeholder="Цена">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Бренд:</strong>
                <input type="text" name="brand" class="form-control" placeholder="Бренд">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Доставка:</strong>
                <input type="date" name="delivery" class="form-control" placeholder="Доставка">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Категория:</strong>
                <input type="text" name="category" class="form-control" placeholder="Категория">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Гарантия:</strong>
                <input type="text" name="warranty" class="form-control" placeholder="Гарантия">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Материал:</strong>
                <input type="text" name="material" class="form-control" placeholder="Материал">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Питание от:</strong>
                <input type="text" name="power_supply" class="form-control" placeholder="Питание от">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Фото:</strong>
                <input type="file" name="product_image" class="form-control" placeholder="Фото">
            </div>
        </div>  


        <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a class="btn btn-primary" href="{{route('admin.products.index')}}">Назад</a>
    </div>


</form>
</div>
@endsection