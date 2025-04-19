@extends('layouts.app')
@section('styles')
    @vite(['resources/css/vacancies.css'])
@endsection
@section('title')Страница сотрудников@endsection
@section('content')

<div class="vacancies-page">
    <h1 class="text-center">Хотите работать у нас?</h1><br>

    <div class="container vacancies-container" id="vacancies-container"></div>
        <template id="vacancy-template">
            <div class="vacancies_block">
                <h3 class="js-title"></h3><br>
                <p class="js-description description"></p><br>
                <p class="js-location">Место работы: </p>
                <p class="js-salary">Оклад: </p>
        
                <div class="button_in_vacancies_block">
                    <a href="#" class="btn btn-info js-details-link">Подробнее</a>
                </div>
            </div>
        </template>
    </div>
</div>
@endsection
