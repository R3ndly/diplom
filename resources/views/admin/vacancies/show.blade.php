@extends('layouts.app')
@section('styles')
    @vite(['resources/css/vacancies.css'])
@endsection
@section('title')Страница сотрудников@endsection
@section('content')

<a href="/admin/vacancies" class="back-to-index" style="display: inline-block; float: left; margin-left: 20px;"></a>

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
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('vacancy-container');
        const vacancy = window.location.pathname.split('/').pop();
        
        fetch(`/api/vacancies/${vacancy}`)
        .then(response => response.json())
        .then(vacancy => {
            if (vacancy.success) {
                const template = document.getElementById('vacancy-template');
                const clone = template.content.cloneNode(true);

                clone.querySelector('.vacancy-title').textContent = vacancy.vacancy.title;
                clone.querySelector('.vacancy-department').textContent += vacancy.vacancy.department;
                clone.querySelector('.vacancy-description').textContent = vacancy.vacancy.description;
                clone.querySelector('.vacancy-location-type').textContent += vacancy.vacancy.location + vacancy.vacancy.type;
                clone.querySelector('.vacancy-salary').textContent += `${ vacancy.vacancy.salary } руб.`;
                clone.querySelector('.vacancy-contact_email').textContent += vacancy.vacancy.contact_email;
                clone.querySelector('.vacancy-contact_phone').textContent += vacancy.vacancy.contact_phone;
                clone.querySelector('.vacancy-publication').textContent += vacancy.vacancy.published_at;

                container.appendChild(clone);
            } else {
                container.innerHTML = '<p style="color: red;">Вакансия не найдена</p>';
            }
        })
        .catch(error => {
            console.error('Error', error);
            container.innerHTML = '<p>Ошибка загрузки данных</p>';
        });
    });
</script>
@endsection