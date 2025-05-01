@extends('layouts.app')
@section('styles')
    @vite(['resources/css/pageBD.css'])
@endsection
@section('title')Редактировать данные сотрудника @endsection
@section('content')

<div class="container container__create-form">
    <div class="row text-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование записи</h2>
            </div>
        </div>
    </div>

    <form id="editWorkerForm">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Имя">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Фамилия:</strong>
                    <input type="text" name="surname" id="surname" class="form-control" placeholder="Фамилия">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Отчество:</strong>
                    <input type="text" name="patronymic" id="patronymic" class="form-control" placeholder="Отчество">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Должность:</strong>
                    <input type="text" name="position" id="position" class="form-control" placeholder="Должность">
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
                    <strong>Дата приема на работу:</strong>
                    <input type="date" name="hire_date" id="hire_date" class="form-control">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Образование:</strong><br>
                    <div class="radio-group">
                        <label for="yes">Имеется</label>
                        <input type="radio" id="yes" name="education" value="1">
                        <label for="no">Отсутствует</label>
                        <input type="radio" id="no" name="education" value="0">
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Номер телефона:</strong>
                    <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Номер телефона">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email адрес:</strong>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email адрес">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
                <button type="submit" class="btn btn-primary">Редактировать</button>
                <a class="btn btn-primary" href="{{ route('admin.workers.index') }}">Назад</a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const workerId = window.location.pathname.split('/').pop();

    fetch(`/api/workers/${workerId}`)
        .then(response => response.json())
        .then(data => {
            const worker = data.worker || data;

            document.getElementById('name').value = worker.name;
            document.getElementById('surname').value = worker.surname;
            document.getElementById('patronymic').value = worker.patronymic || '';
            document.getElementById('position').value = worker.position;
            document.getElementById('salary').value = worker.salary;
            document.getElementById('hire_date').value = worker.hire_date;
            document.getElementById('phone_number').value = worker.phone_number;
            document.getElementById('email').value = worker.email || '';

            if(worker.education) {
                document.getElementById('yes').checked = true;
            } else {
                document.getElementById('no').checked = true;
            }
        })
        .catch(error => {
            console.error('Ошибка загрузки данных:', error);
        });

    document.getElementById('editWorkerForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = {
            name: document.getElementById('name').value,
            surname: document.getElementById('surname').value,
            patronymic: document.getElementById('patronymic').value,
            position: document.getElementById('position').value,
            salary: document.getElementById('salary').value,
            hire_date: document.getElementById('hire_date').value,
            education: document.querySelector('input[name="education"]:checked').value,
            phone_number: document.getElementById('phone_number').value,
            email: document.getElementById('email').value,
            _method: 'PUT' // Laravel требует для PUT-запросов
        };

        try {
            const response = await fetch(`/api/workers/${workerId}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw errorData;
            }

            window.location.href = '/admin/workers';
        } catch (error) {
            console.error('Ошибка при обновлении:', error);
            alert('Произошла ошибка: ' + (error.message || 'Проверьте введенные данные'));
        }
    });
});
</script>
@endsection
