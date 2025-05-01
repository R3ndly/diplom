@extends('layouts.app')
@section('styles')
    @vite(['resources/css/pageBD.css'])
@endsection
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
    <form id="createWorkerForm">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Имя" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Фамилия:</strong>
                    <input type="text" name="surname" class="form-control" placeholder="Фамилия" required>
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
                    <input type="text" name="position" class="form-control" placeholder="Должность" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Зарплата:</strong>
                    <input type="number" name="salary" class="form-control" placeholder="Зарплата" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дата приема на работу:</strong>
                    <input type="date" name="hire_date" class="form-control" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Образование:</strong><br>
                    <div class="radio-group">
                        <label for="yes">Имеется</label>
                        <input type="radio" id="yes" name="education" value="1" checked>
                        <label for="no">Отсутствует</label>
                        <input type="radio" id="no" name="education" value="0">
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Номер телефона:</strong>
                    <input type="tel" name="phone_number" class="form-control" placeholder="Номер телефона" required>
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
                <a class="btn btn-primary" href="/admin/workers">Назад</a>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('createWorkerForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);

        // Преобразование education в boolean
        data.education = data.education === '1';

        try {
            const response = await fetch('/api/workers', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw errorData;
            }

            window.location.href = '/admin/workers';
        } catch (error) {
            console.error('Ошибка при создании сотрудника:', error);
            alert('Произошла ошибка: ' + (error.message || 'Проверьте введенные данные'));
        }
    });
</script>
@endsection
