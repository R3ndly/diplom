@extends('layouts.app')
@section('title')Редактировать данные вакансии @endsection
@section('content')

<div class="row text-center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Редактирование вакансии</h2>
        </div>
    </div>
</div>


<div class="container container__create-form">

<form action="{{ route('admin.vacancies.update',$vacancy->vacancy_id) }}" method="POST">

@csrf
@method('PUT')

 <div class="row">

 <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                <input type="text" name="title" value="{{ $vacancy->title }}" class="form-control" placeholder="Название">
            </div>
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Описание:</strong>
                <input type="text" name="description" value="{{ $vacancy->description }}" class="form-control" placeholder="Описание">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Должность:</strong>
                <input type="text" name="department" value="{{ $vacancy->department }}" class="form-control" placeholder="Должность">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Место работы:</strong>
                <input type="text" name="location" value="{{ $vacancy->location }}" class="form-control" placeholder="Место работы">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Рабочий день:</strong>
                <input type="text" name="type" value="{{ $vacancy->type }}" class="form-control" placeholder="Рабочий день">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Зарплата:</strong>
                <input type="number" name="salary" value="{{ $vacancy->salary }}" class="form-control" placeholder="Зарплата">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email адрес:</strong>
                <input type="email" name="contact_email" value="{{ $vacancy->contact_email }}" class="form-control" placeholder="Email адрес">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Номер телефона:</strong>
                <input type="tel" name="contact_phone" value="{{ $vacancy->contact_phone }}" class="form-control" placeholder="Номер телефона">
            </div>
        </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
    <button type="submit" class="btn btn-primary">Редактировать</button>
    <a class="btn btn-primary" href="{{route('admin.vacancies.index')}}">Назад</a>
</div>

</div>
</div>
</form>

@endsection