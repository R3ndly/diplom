@extends('layouts.app')
@section('title')Редактировать данные сотрудника @endsection
@section('content')

<div class="row text-center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Редактирование запись</h2>
        </div>
    </div>
</div>


<div class="container container__create-form">

<form action="{{ route('admin.workers.update',$worker->worker_id) }}" method="POST">

@csrf
@method('PUT')

 <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Имя:</strong>
                <input type="text" name="name" value="{{ $worker->name }}" class="form-control" placeholder="Имя">
            </div>
        </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Фамилия:</strong>

            <input type="text" name="surname" value="{{ $worker->surname }}" class="form-control" placeholder="Фамилия">

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Отчество:</strong>

            <input type="text" name="patronymic" value="{{ $worker->patronymic }}" class="form-control" placeholder="Отчество">

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Должность:</strong>

            <input type="text" name="position" value="{{ $worker->position }}" class="form-control" placeholder="Должность">

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Зарплата:</strong>

            <input type="text" name="salary" value="{{ $worker->salary }}" class="form-control" placeholder="Зарплата">

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Дата приема на работу:</strong>

            <input type="date" name="hire_date" value="{{ $worker->hire_date }}" class="form-control" placeholder="Дата приема на работу">

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Образование:</strong>

            <label for="yes">Есть образование</label>
            <input type="radio" id="yes" name="education" value="1"><br>
            <label for="no">Нет образования</label>
            <input type="radio" id="no" name="education" value="0"><br>

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">


<div class="form-group">

    <strong>Номер телефона:</strong>

    <input type="text" name="phone_number" value="{{ $worker->phone_number }}" class="form-control" placeholder="Номер телефона">

</div>

</div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Email адрес:</strong>

            <input type="email" name="email" value="{{ $worker->email }}" class="form-control" placeholder="Email адрес">

        </div>

    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
    <button type="submit" class="btn btn-primary">Редактировать</button>
    <a class="btn btn-primary" href="{{route('admin.workers.index')}}">Назад</a>
</div>

</div>
</div>
</form>

@endsection