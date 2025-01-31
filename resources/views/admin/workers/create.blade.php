@extends('layouts.app')
@section('title') Добавление сотрудника @endsection
@section('content')

<div class="row text-center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Добавить сотрудника</h2>
        </div>
    </div>
</div>

<div class="container container__create-form">

<form action="{{route('admin.workers.store')}}" method="POST" enctype="multipart/form-data">
    
@csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Имя:</strong>
                <input type="text" name="name" class="form-control" placeholder="Имя">
            </div>
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Фамилия:</strong>
                <input type="text" name="surname" class="form-control" placeholder="Фамилия">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Отчество:</strong>
                <input type="text" name="patronymic" class="form-control" placeholder="Отчество">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Должность:</strong>
                <input type="text" name="position" class="form-control" placeholder="Должность">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Зарплата:</strong>
                <input type="text" name="salary" class="form-control" placeholder="Зарплата">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Дата приема на работу:</strong>
                <input type="date" name="hire_date" class="form-control" placeholder="Дата приема на работу">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Образование:</strong>
                <label for="yes">Имеется</label>
                <input type="radio" id="yes" name="education" value="1"><br>
                <label for="no">Отсутствует</label>
                <input type="radio" id="no" name="education" value="0"><br>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Номер телефона:</strong>
                <input type="tel" name="phone_number" class="form-control" placeholder="Номер телефона">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email адрес:</strong>
                <input type="email" name="email" class="form-control" placeholder="Email адрес">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a class="btn btn-primary" href="{{route('admin.workers.index')}}">Назад</a>
    </div>


</form>
</div>
@endsection