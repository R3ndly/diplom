@extends('layouts.app')
@section('title')Страница сотрудников @endsection
@section('content')
<h1 class="text-center ">Наши сотрудники</h1><br>


<div class="row">
<div class="col-lg-12 margin-tb">
    <div class="pull-left">

        <div id="myModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeWindow()">&times;</span>
        <h2>Информация о сотруднике</h2>
        <div id="workerDetails" class="details-bd"></div>
    </div>
</div>

    </div>
</div>

</div>
<div class="container">
    <table class="table">
        <tr class="title__table">
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Должность</th>
            <th>Дата приема на работу</th>
            <th width="280px">Действия</th>
        </tr>

        @foreach ($workers as $worker)
<tr>
    <td id="workerName_{{ $worker->worker_id }}">{{ $worker->name }}</td>
    <td>{{ $worker->surname }}</td>
    <td>{{ $worker->position }}</td>
    <td>{{ $worker->hire_date }}</td>

    <td>
        <div class="action-buttons">
            <input type="button" class="pokazat" onclick="showWorkerDetails({{ json_encode($worker) }})" />
        </div>
    </td>

</tr>
@endforeach
    </table>
</div>

<script type="text/javascript">
function showWorkerDetails(worker) {
    var educationText = worker.education ? "Имеется" : "Отсутствует";
    var detailsHtml = `
     <div class="window-info">
        <div><strong>Имя:</strong> ${worker.name}</div>
        <div><strong>Фамилия:</strong> ${worker.surname}</div>
        <div><strong>Отчество:</strong> ${worker.patronymic}</div>
        <div><strong>Должность:</strong> ${worker.position}</div>
        <div><strong>Зарплата:</strong> ${worker.salary}</div>
        <div><strong>Дата приема на работу:</strong> ${worker.hire_date}</div>
        <div><strong>Образование:</strong> ${educationText}</div>
        <div><strong>Номер телефона:</strong> ${worker.phone_number}</div>
        <div><strong>Email адрес:</strong> ${worker.email}</div>
        </div>
    `;

    // Заполнение модального окна данными о работнике
    document.getElementById('workerDetails').innerHTML = detailsHtml;

    // Показываем модальное окно
    document.getElementById('myModal').style.display = "block";
}

function closeWindow() {
    // Скрываем модальное окно
    document.getElementById('myModal').style.display = "none";
}
</script>


@endsection