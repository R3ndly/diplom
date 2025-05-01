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

        <div class="pagination-container">
            <button id="prev-page" class="btn btn-pagination" disabled>Назад</button>
            <button id="next-page" class="btn btn-pagination">Вперёд</button>
        </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let page = 1;
    const container = document.getElementById('vacancies-container');
    const template = document.getElementById('vacancy-template');

    const loadVacancies = async () => {
        try {
            const response = await fetch(`/api/vacancies?page=${page}`);
            const data = await response.json();

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

            document.getElementById('prev-page').disabled = data.vacancies.current_page === 1;
            document.getElementById('next-page').disabled = data.vacancies.current_page === data.vacancies.last_page;

        } catch (error) {
            container.innerHTML = '<div class="alert alert-danger">Ошибка загрузки</div>';
            console.error(error);
        }
    };

    document.getElementById('prev-page').onclick = () => { if (page > 1) loadVacancies(--page); };
    document.getElementById('next-page').onclick = () => loadVacancies(++page);

    loadVacancies();
});
</script>
@endsection
