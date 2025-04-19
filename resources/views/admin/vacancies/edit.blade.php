@extends('layouts.app')
@section('styles')
    @vite(['resources/css/vacancies.css'])
@endsection
@section('title')Редактировать данные вакансии @endsection
@section('content')



<div class="container container__create-form">
    <div class="row text-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование вакансии</h2>
            </div>
        </div>
    </div>

<form id="editVacancyForm">
 <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                <input type="text" name="title" id="title" class="form-control" placeholder="Название">
            </div>
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Описание:</strong>
                <input type="text" name="description" id="description" class="form-control" placeholder="Описание">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Должность:</strong>
                <input type="text" name="department" id="department" class="form-control" placeholder="Должность">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Место работы:</strong>
                <input type="text" name="location" id="location" class="form-control" placeholder="Место работы">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Рабочий день:</strong>
                <input type="text" name="type" id="type" class="form-control" placeholder="Рабочий день">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Зарплата:</strong>
                <input type="number" name="salary" id="salary" class="form-control" placeholder="Зарплата">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email адрес:</strong>
                <input type="email" name="contact_email" id="contact_email" class="form-control" placeholder="Email адрес">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Номер телефона:</strong>
                <input type="tel" name="contact_phone" id="contact_phone" class="form-control" placeholder="Номер телефона">
            </div>
        </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
    <button type="submit" class="btn btn-primary">Редактировать</button>
    <a class="btn btn-primary" href="/admin/vacancies">Назад</a>



</div>
</form>
@endsection