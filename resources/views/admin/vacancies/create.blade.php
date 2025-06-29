@extends('layouts.app')
@section('styles')
    @vite(['resources/css/vacancies.css'])
@endsection
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
    <form id="createVacancyForm">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Название:</strong>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Название" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Описание:</strong>
                    <textarea name="description" id="description" class="form-control" placeholder="Описание" required></textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Отдел:</strong>
                    <select name="department_id" id="departmentSelect" class="form-control" required>
                        <option value="">Загрузка отделов...</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Местоположение:</strong>
                    <select name="location_id" id="locationSelect" class="form-control" required>
                        <option value="">Загрузка местоположений...</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>График работы:</strong>
                    <select name="working_hours_id" id="workingHoursSelect" class="form-control" required>
                        <option value="">Загрузка графиков...</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Зарплата:</strong>
                    <input type="number" name="salary" id="salary" class="form-control" placeholder="Зарплата" step="0.01" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Контактное лицо:</strong>
                    <select name="worker_id" id="workerSelect" class="form-control" required>
                        <option value="">Загрузка контактных лиц...</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
                <button type="submit" class="btn btn-primary">Добавить</button>
                <a class="btn btn-primary" href="/admin/vacancies">Назад</a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentWorkersPage = 1;
    let isLoadingWorkers = false;
    let hasMoreWorkers = true;

    const workerSelect = document.getElementById('workerSelect');

    async function loadDictionaries() {
        try {
            const [departments, locations, workingHours, workers] = await Promise.all([
                fetch('/api/departments').then(res => res.json()),
                fetch('/api/locations').then(res => res.json()),
                fetch('/api/working-hours').then(res => res.json()),
                fetch('/api/workers').then(res => res.json())
            ]);

            fillSelect('departmentSelect', departments, 'department_id', 'department');
            fillSelect('locationSelect', locations, 'location_id', 'location');
            fillSelect('workingHoursSelect', workingHours, 'working_hours_id', 'working_hours');
            fillSelect('workerSelect', workers.workers.data, 'worker_id', ['surname', 'name', 'patronymic', 'position']);

        } catch (error) {
            console.error('Ошибка загрузки справочников:', error);
        }
    }

    function fillSelect(selectId, data, valueField, textFields) {
        const select = document.getElementById(selectId);

        select.innerHTML = '';
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = `Выберите ${selectId.replace('Select', '').toLowerCase()}`;
        select.appendChild(defaultOption);

        const isMultiField = Array.isArray(textFields);

        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item[valueField];

            if (isMultiField) {
            const parts = textFields.map(field => item[field]).filter(Boolean);
            option.textContent = parts.join(' ');
            } else {
                option.textContent = item[textFields];
            }

            if (isMultiField) {
                option.title = textFields.map(field => `${field}: ${item[field]}`).join('\n');
            }

            select.appendChild(option);
        });
    }

    document.getElementById('createVacancyForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = {
            title: document.getElementById('title').value,
            description: document.getElementById('description').value,
            department_id: document.getElementById('departmentSelect').value,
            location_id: document.getElementById('locationSelect').value,
            working_hours_id: document.getElementById('workingHoursSelect').value,
            worker_id: document.getElementById('workerSelect').value,
            salary: document.getElementById('salary').value
        };

        try {
            const response = await fetch('/api/vacancies', {
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

            window.location.href = '/admin/vacancies';
        } catch (error) {
            console.error('Ошибка при создании:', error);

            if (error.errors) {
                let errorMessage = '';
                for (const [field, messages] of Object.entries(error.errors)) {
                    errorMessage += `${messages.join(', ')}\n`;
                }
            }
        }
    });

    loadDictionaries();
});
</script>
@endsection
