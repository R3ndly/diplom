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
                    <div class="input-group">
                        <select name="position_id" id="positionSelect" class="form-control" required>
                            <option value="">Загрузка должностей...</option>
                        </select>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="showPositionInput">+</button>
                        </div>
                    </div>
                    <div id="newPositionContainer" style="display: none;">
                        <input type="text" id="newPositionInput" class="form-control mt-2" placeholder="Введите новую должность">
                        <button type="button" id="addPositionBtn" class="btn btn-primary mt-2">Добавить</button>
                    </div>
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
                    <strong>Образование:</strong>
                    <select name="education_id" class="form-control" required>
                        <option value="1">Имеется</option>
                        <option value="2">Отсутствует</option>
                    </select>
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
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('positionSelect');
    const showBtn = document.getElementById('showPositionInput');
    const newContainer = document.getElementById('newPositionContainer');
    const addBtn = document.getElementById('addPositionBtn');

    loadPositions();

    showBtn.addEventListener('click', function() {
        newContainer.style.display = 'block';
        this.style.display = 'none';
    });

    addBtn.addEventListener('click', addNewPosition);

    document.getElementById('createWorkerForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const submitBtn = e.target.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Создание...';

        try {
            const formData = {
                name: e.target.elements.name.value.trim(),
                surname: e.target.elements.surname.value.trim(),
                patronymic: e.target.elements.patronymic.value.trim(),
                position_id: parseInt(e.target.elements.position_id.value),
                salary: parseFloat(e.target.elements.salary.value),
                hire_date: e.target.elements.hire_date.value,
                education_id: parseInt(e.target.elements.education_id.value),
                phone_number: e.target.elements.phone_number.value.trim(),
                email: e.target.elements.email.value.trim()
            };

            const response = await fetch('/api/workers', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Ошибка сервера');
            }

            window.location.href = '/admin/workers';

        } catch (error) {
            console.error('Ошибка:', error);
            alert('Ошибка: ' + error.message);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Добавить';
        }
    });
});

async function loadPositions() {
    const select = document.getElementById('positionSelect');

    try {
        const response = await fetch('/api/positions');

        if (!response.ok) {
            throw new Error('Ошибка загрузки должностей');
        }

        const positions = await response.json();

        select.innerHTML = '';

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = '-- Выберите должность --';
        select.appendChild(defaultOption);

        positions.forEach(position => {
            const option = document.createElement('option');
            option.value = position.position_id;
            option.textContent = position.position_name;
            select.appendChild(option);
        });

    } catch (error) {
        console.error('Ошибка:', error);
        select.innerHTML = '<option value="">Ошибка загрузки должностей</option>';
    }
}

async function addNewPosition() {
    const positionName = document.getElementById('newPositionInput').value.trim();
    if (!positionName) return;

    try {
        const response = await fetch('/api/position', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ position_name: positionName })
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Ошибка сервера');
        }

        await loadPositions();
        const select = document.getElementById('positionSelect');
        const newOption = Array.from(select.options)
            .find(option => option.text === positionName);

        if (newOption) {
            select.value = newOption.value;
        }

        document.getElementById('newPositionContainer').style.display = 'none';
        document.getElementById('showPositionInput').style.display = 'block';
        document.getElementById('newPositionInput').value = '';

    } catch (error) {
        console.error('Ошибка:', error);
        alert('Ошибка: ' + error.message);
    }
}</script>
@endsection
