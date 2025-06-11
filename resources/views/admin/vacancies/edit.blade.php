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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const vacancy = window.location.pathname.split('/').pop();
    fetch(`/api/vacancies/${vacancy}`)
    .then(response => response.json())
    .then(data => {
        document.getElementById('title').value = data.vacancy.title;
        document.getElementById('description').value = data.vacancy.description;
        document.getElementById('department').value = data.vacancy.department;
        document.getElementById('location').value = data.vacancy.location;
        document.getElementById('type').value = data.vacancy.type;
        document.getElementById('salary').value = data.vacancy.salary;
        document.getElementById('contact_email').value = data.vacancy.contact_email;
        document.getElementById('contact_phone').value = data.vacancy.contact_phone;
    });
});

const formElement = document.getElementById('editVacancyForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const formData = {
            title: document.getElementById('title').value,
            description: document.getElementById('description').value,
            department: document.getElementById('department').value,
            location: document.getElementById('location').value,
            type: document.getElementById('type').value,
            salary: document.getElementById('salary').value,
            contact_email: document.getElementById('contact_email').value,
            contact_phone: document.getElementById('contact_phone').value,
        };
    const vacancy = window.location.pathname.split('/').pop();

    try {
        const response = await fetch(`/api/vacancies/${vacancy}`, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        });
        if(!response.ok) {
            const ErrorData = await response.json();
            throw ErrorData;
        }
        window.location.href = '/admin/vacancies';
    } catch (error) {
        console.error('Ошибочка -> ', error);
    }
});
</script>
@endsection
