@extends('layouts.app')
@section('title')Страница сотрудников @endsection
@section('content')
<h1 class="text-center ">Наши вакансии</h1><br>


<div class="row">
<div class="col-lg-12 margin-tb">
    <div class="pull-left">

        <div id="myModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeWindow()">&times;</span>
        <h2>Информация о вакансии</h2>
        <div id="vacancyDetails" class="details-bd"></div>
    </div>
</div>

    </div>
</div>

</div>
<div class="container">
    <table class="table">
        <tr class="title__table">
            <th>Название</th>
            <th>Должность</th>
            <th>Место работы</th>
            <th>Рабочий день</th>
            <th>Зарплата</th>
            <th width="280px">Действия</th>
        </tr>

        @foreach ($vacancies as $vacancy)
<tr>
    <td id="vacancyTitle_{{ $vacancy->vacancies_id }}">{{ $vacancy->title }}</td>
    <td>{{ $vacancy->department }}</td>
    <td>{{ $vacancy->location }}</td>
    <td>{{ $vacancy->type }}</td>
    <td>{{ $vacancy->salary }}</td>

    <td>
        <div class="action-buttons">
            <input type="button" class="pokazat" onclick="showVacancyDetails({{ json_encode($vacancy) }})" />
        </div>
    </td>

</tr>
@endforeach
    </table>
</div>

<script type="text/javascript">
function showVacancyDetails(vacancy) {

    var detailsHtml = `
     <div class="window-info">
        <div><strong>Название:</strong> ${vacancy.title}</div>
        <div><strong>Описание:</strong> ${vacancy.description}</div>
        <div><strong>Должность:</strong> ${vacancy.department}</div>
        <div><strong>Место работы:</strong> ${vacancy.location}</div>
        <div><strong>Рабочий день:</strong> ${vacancy.type}</div>
        <div><strong>Зарплата:</strong> ${vacancy.salary}</div>
        <div><strong>Дата публикации вакансии:</strong> ${vacancy.published_at}</div>
        <div><strong>Email:</strong> ${vacancy.contact_email}</div>
        <div><strong>Контактный телефон:</strong> ${vacancy.contact_phone}</div>
        </div>
    `;

    // Заполнение модального окна данными о работнике
    document.getElementById('vacancyDetails').innerHTML = detailsHtml;

    // Показываем модальное окно
    document.getElementById('myModal').style.display = "block";
}

function closeWindow() {
    // Скрываем модальное окно
    document.getElementById('myModal').style.display = "none";
}
</script>


@endsection