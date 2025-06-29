@extends('layouts.app')
@section('styles')
    @vite(['resources/css/vacancies.css'])
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

        <div class="paginate__menu" id="pagination-links"></div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('vacancies-container');
    const template = document.getElementById('vacancy-template');
    const paginationContainer = document.getElementById('pagination-links');
    let currentPage = 1;

    const loadVacancies = async () => {
        try {
            const response = await fetch(`/api/vacancies?page=${currentPage}`);
            const data = await response.json();

            if (!data.vacancies || !data.vacancies.data) {
                throw new Error('Invalid data format');
            }

            container.innerHTML = '';
            data.vacancies.data.forEach(vacancy => {
                const clone = template.content.cloneNode(true);

                clone.querySelector('.js-title').textContent = vacancy.title;
                clone.querySelector('.js-description').textContent = vacancy.description;
                clone.querySelector('.js-location').textContent += vacancy.location;
                clone.querySelector('.js-salary').textContent += vacancy.salary + ' руб.';

                clone.querySelector('.js-edit-link').href = `/admin/vacancies/edit/${vacancy.vacancy_id}`;
                clone.querySelector('.js-details-link').href = `/admin/vacancies/${vacancy.vacancy_id}`;

                clone.querySelector('.js-delete-form').onsubmit = async (event) => {
                    event.preventDefault();
                    await fetch(`/api/vacancies/${vacancy.vacancy_id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    loadVacancies();
                };
                container.appendChild(clone);
            });

            renderPagination(data.vacancies);

        } catch (error) {
            container.innerHTML = '<div class="alert alert-danger">Ошибка загрузки</div>';
            console.error(error);
        }
    };

    function renderPagination(pagination) {
        let links = '';

        if (pagination.prev_page_url) {
            links += `<button id="prev-page" onclick="loadPage(${pagination.current_page - 1})" class="page-link btn">&laquo; Назад</button> `;
        }

        if (pagination.next_page_url) {
            links += `<button id="next-page" onclick="loadPage(${pagination.current_page + 1})" class="page-link btn">Вперед &raquo;</button>`;
        }

        paginationContainer.innerHTML = links;
    }

    window.loadPage = function(page) {
        currentPage = page;
        loadVacancies();
        return false;
    }

    loadVacancies();
});</script>
@endsection
