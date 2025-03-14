@extends('layouts.app')
@section('title')Страница сотрудников @endsection
@section('content')

<h1 class="text-center">Наши сотрудники</h1>

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
        <div class="pull-right">
            <a class="btn btn-primary w-80" href="{{ route('admin.workers.create') }}"> Добавить сотрудника</a>
        </div>
</div>

<div class="container container__table__workers">
    <table class="table__workers">
        <tr class="title__table">
            <th class="name__worker">Имя</th>
            <th>Фамилия</th>
            <th>Должность</th>
            <th class="date_of_employment">Дата приема на работу</th>
            <th width="280px">Действия</th>
        </tr>

        @foreach ($workers as $worker)
        <tr>
            <td class="name__worker" id="workerName_{{ $worker->worker_id }}">{{ $worker->name }}</td>
            <td>{{ $worker->surname }}</td>
            <td>{{ $worker->position }}</td>
            <td class="date_of_employment">{{ $worker->hire_date }}</td>

            <td>
                <div class="action-buttons">
                    <input type="button" class="pokazat" onclick="showWorkerDetails({{ json_encode($worker) }})" />

                    <form action="{{ route('admin.workers.destroy', $worker->worker_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="ydalit"></button>
                    </form>

                    <form action="{{ route('admin.workers.edit', $worker->worker_id) }}" method="GET">
                        <button type="submit" class="izmenit"></button>
                    </form>
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
        <div><strong>ФИО:</strong>${worker.surname} ${worker.name} ${worker.patronymic}</div>
        <div><strong>Должность:</strong> ${worker.position}</div>
        <div><strong>Зарплата:</strong> ${worker.salary} руб.</div>
        <div><strong>Трудоустроен с:</strong> ${worker.hire_date}</div>
        <div><strong>Образование:</strong> ${educationText}</div>
        <div><strong>Номер телефона:</strong> ${worker.phone_number}</div>
        <div><strong>электронная почта:</strong> ${worker.email}</div>
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
