@extends('layouts.app')
@section('title') Добавление вакансии @endsection
@section('content')

<div class="row text-center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Добавить вакансию</h2>
        </div>
    </div>
</div>

<div class="container container__create-form">

<form action="{{route('admin.vacancies.store')}}" method="POST">
    
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
                <strong>Описание:</strong>
                <input type="text" name="description" class="form-control" placeholder="Описание">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Должность:</strong>
                <input type="text" name="department" class="form-control" placeholder="Должность">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Место работы:</strong>
                <input type="text" name="location" class="form-control" placeholder="Место работы">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Рабочий день:</strong>
                <input type="text" name="type" class="form-control" placeholder="Рабочий день">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Зарплата:</strong>
                <input type="number" name="salary" class="form-control" placeholder="Зарплата">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email адрес:</strong>
                <input type="email" name="contact_email" class="form-control" placeholder="Email адрес">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Номер телефона:</strong>
                <input type="tel" name="contact_phone" class="form-control" placeholder="Номер телефона">
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a class="btn btn-primary" href="{{route('admin.vacancies.index')}}">Назад</a>
    </div>


</form>
</div>
@endsection