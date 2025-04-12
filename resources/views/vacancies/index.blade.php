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
<script> 
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/api/vacancies')
        .then(response => response.json())
        .then(vacancies => {
            const container = document.getElementById('vacancies-container');
            container.replaceChildren();
            
            vacancies.vacancies.data.forEach(vacancy => {
                const template = document.getElementById('vacancy-template');
                const clone = template.content.cloneNode(true);
                
                clone.querySelector('.js-title').textContent = vacancy.title;
                clone.querySelector('.js-description').textContent = vacancy.description;
                clone.querySelector('.js-location').textContent += vacancy.location;
                clone.querySelector('.js-salary').textContent += `${ vacancy.salary } руб.`;
                
                clone.querySelector('.js-details-link').href = `/vacancies/${ vacancy.vacancy_id }`;
                
                container.appendChild(clone);
            });
        })
        .catch(error => {
            console.error('Ошибка: ', error);
            container.innerHTML = `<p style="color: red;">Ошибка загрузки вакансий</p>`;
        });
    });
</script>
@endsection
