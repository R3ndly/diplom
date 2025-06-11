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
         <div class="pagination-container">
            <button id="prev-page" class="btn btn-pagination" disabled>Назад</button>
            <button id="next-page" class="btn btn-pagination">Вперёд</button>
         </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let page = 1;
        const container = document.getElementById('vacancies-container');
        const template = document.getElementById('vacancy-template');

        const loadVacancies = async () => {
            try {
                const response = await fetch(`/api/vacancies/?page=${page}`);
                const data = await response.json();

                container.innerHTML = '';

                data.vacancies.data.forEach(vacancy => {
                    const clone = template.content.cloneNode(true);

                    clone.querySelector('.js-title').textContent = vacancy.title;
                    clone.querySelector('.js-description').textContent = vacancy.description;
                    clone.querySelector('.js-location').textContent += vacancy.location;
                    clone.querySelector('.js-salary').textContent += vacancy.salary;
                    clone.querySelector('.js-details-link').href = `/vacancies/${vacancy.vacancy_id}`;

                    container.appendChild(clone);
                });

                document.getElementById('prev-page').disabled = data.vacancies.current_page === 1;
                document.getElementById('next-page').disabled = data.vacancies.current_page === data.vacancies.last_page;

            } catch (error) {
                console.error(error);
            }
        };

        document.getElementById('prev-page').onclick = () => { if(page > 1) loadVacancies(--page) };
        document.getElementById('next-page').onclick = () => loadVacancies(++page);

        loadVacancies();
    });
</script>
@endsection
