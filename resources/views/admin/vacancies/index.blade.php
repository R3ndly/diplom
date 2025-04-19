@extends('layouts.app')
@section('styles')
    @vite(['resources/css/vacancies.css', 'resources/js/admin/vacancies/index.js'])
@endsection
@section('title')Страница сотрудников@endsection
@section('content')

<div class="vacancies-page">
    <h1 class="text-center">Хотите работать у нас?</h1><br>

    <div class="pull-right">
        <a class="btn btn-primary" href="/admin/vacancies/create">Добавить вакансию</a>
    </div><br><br>

    <div class="container vacancies-container" id="vacancies-container"></div>

        <template id="vacancy-template">
            <div class="vacancies_block">
                <h3 class="js-title"></h3><br>
                <p class="js-description description"></p><br>
                <p class="js-location">Место работы: </p>
                <p class="js-salary">Оклад: </p>

                <a href="#" class="js-edit-link">Редактировать</a>

                <div class="button_in_vacancies_block">
                    <a href="#" class="btn btn-info js-details-link">Подробнее</a>

                    <form action="#" class="js-delete-form">
                        <button type="submit" class="btn btn-info">Удалить</button>
                    </form>
                </div>
            </div>
        </template>

        <div class="pagination-container">
            <button id="prev-page" class="btn btn-pagination" disabled>Назад</button>
            <button id="next-page" class="btn btn-pagination">Вперёд</button>
        </div>
@endsection
