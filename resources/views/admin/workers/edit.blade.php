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
            <!-- Личные данные -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Имя" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Фамилия:</strong>
                    <input type="text" name="surname" id="surname" class="form-control" placeholder="Фамилия" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Отчество:</strong>
                    <input type="text" name="patronymic" id="patronymic" class="form-control" placeholder="Отчество">
                </div>
            </div>

            <!-- Должность (select) -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Должность:</strong>
                    <select name="position_id" id="positionSelect" class="form-control" required>
                        <option value="">Загрузка должностей...</option>
                    </select>
                </div>
            </div>

            <!-- Зарплата и дата -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Зарплата:</strong>
                    <input type="number" name="salary" id="salary" class="form-control" placeholder="Зарплата" step="0.01" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дата приема на работу:</strong>
                    <input type="date" name="hire_date" id="hire_date" class="form-control" required>
                </div>
            </div>

            <!-- Образование (select) -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Образование:</strong>
                    <select name="education_id" id="educationSelect" class="form-control" required>
                        <option value="1">Имеется</option>
                        <option value="2">Отсутствует</option>
                    </select>
                </div>
            </div>

            <!-- Контакты -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Номер телефона:</strong>
                    <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Номер телефона" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email адрес:</strong>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email адрес">
                </div>
            </div>

            <!-- Кнопки -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                <a class="btn btn-primary" href="{{ route('admin.workers.index') }}">Назад</a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const workerId = window.location.pathname.split('/').pop();

    Promise.all([
        fetch(`/api/workers/${workerId}`).then(res => res.json()),
        fetch('/api/positions').then(res => res.json())
    ])
    .then(([workerData, positions]) => {
        const worker = workerData.worker || workerData;

        document.getElementById('name').value = worker.name;
        document.getElementById('surname').value = worker.surname;
        document.getElementById('patronymic').value = worker.patronymic || '';
        document.getElementById('salary').value = worker.salary;
        document.getElementById('hire_date').value = worker.hire_date;
        document.getElementById('phone_number').value = worker.phone_number;
        document.getElementById('email').value = worker.email || '';

        const positionSelect = document.getElementById('positionSelect');
        positionSelect.innerHTML = '';

        positions.forEach(position => {
            const option = new Option(position.position_name, position.position_id);
            positionSelect.add(option);
        });

        if (worker.position_id) {
            positionSelect.value = worker.position_id;
        }

        const educationSelect = document.getElementById('educationSelect');
        if (worker.education_id) {
            educationSelect.value = worker.education_id;
        } else {
            educationSelect.value = worker.education ? '1' : '2';
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
            position_id: document.getElementById('positionSelect').value,
            salary: document.getElementById('salary').value,
            hire_date: document.getElementById('hire_date').value,
            education_id: document.getElementById('educationSelect').value,
            phone_number: document.getElementById('phone_number').value,
            email: document.getElementById('email').value,
            _method: 'PUT'
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
