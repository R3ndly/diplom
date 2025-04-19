@extends('layouts.app')
@section('styles')
    @vite(['resources/css/vacancies.css', 'resources/js/admin/vacancies/show.js'])
@endsection
@section('title')Страница сотрудников@endsection
@section('content')

<a href="/admin/vacancies" class="back-to-index" style="display: inline-block; margin-left: 20px;"></a>

<div class="container">
    <div class="about_vacancy" id="vacancy-container"></div>
        <template id="vacancy-template">
            <h1>Подробная информация о вакансии <strong class="vacancy-title"></strong></h1><br>

            <h3>О вакансии:</h3>
            <p class="vacancy-department">Должность: </p>
            <p class="vacancy-description"></p><br>

            <h3>Условия:</h3>
            <p class="vacancy-location-type">Формат работы: </p>
            <p class="vacancy-salary">Зарплата: </p>

            <h4>Если вы заинтересованны в работе у нас, просим откликнуться на один из слудующих способов связи:</h4>
            <p class="vacancy-contact_email">Почта: </p>
            <p class="vacancy-contact_phone">Телефон: </p>

            <p class="vacancy-publication" style="text-align: right;">Дата публикации вакансии -> </p>
        </template>
</div>
@endsection
