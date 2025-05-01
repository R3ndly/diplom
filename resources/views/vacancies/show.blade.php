@extends('layouts.app')
@section('styles')
    @vite(['resources/css/vacancies.css'])
@endsection
@section('title')Страница сотрудников@endsection
@section('content')

<a href="/vacancies" class="back-to-index" style="display: inline-block; float: left; margin-left: 20px;"></a>

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
    document.addEventListener('DOMContentLoaded',async function() {
        const container = document.getElementById('vacancy-container');
        const template = document.getElementById('vacancy-template');

        const vacancyId = window.location.pathname.split('/').pop();

        try {
            const response = await fetch(`/api/vacancies/${vacancyId}`)
            const data = await response.json();
                if (data.success) {
                    const clone = template.content.cloneNode(true);

                    clone.querySelector('.vacancy-title').textContent = data.vacancy.title;
                    clone.querySelector('.vacancy-department').textContent += data.vacancy.department;
                    clone.querySelector('.vacancy-description').textContent = data.vacancy.description;
                    clone.querySelector('.vacancy-location-type').textContent += `${data.vacancy.location}, ${data.vacancy.type}`;
                    clone.querySelector('.vacancy-salary').textContent += `${ data.vacancy.salary } руб.`;
                    clone.querySelector('.vacancy-contact_email').textContent += data.vacancy.contact_email;
                    clone.querySelector('.vacancy-contact_phone').textContent += data.vacancy.contact_phone;
                    clone.querySelector('.vacancy-publication').textContent += data.vacancy.published_at;

                    container.appendChild(clone);
               } else {
                    container.innerHTML = '<p style="color: red;">Вакансия не найдена</p>';
                }
            } catch (error) {
                console.error(error);
            }
    });
</script>
@endsection
