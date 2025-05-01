@extends('layouts.app')
@section('styles')
    @vite(['resources/css/pageBD.css'])
@endsection
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
            <a class="btn btn-primary w-80" href="/admin/workers/create">Добавить сотрудника</a>
        </div>
    </div>
</div>

<div class="container container__table__workers">
    <table class="table__workers">
        <thead>
            <tr class="title__table">
                <th class="name__worker">Имя</th>
                <th>Фамилия</th>
                <th>Должность</th>
                <th class="date_of_employment">Дата приема на работу</th>
                <th width="280px">Действия</th>
            </tr>
        </thead>
        <tbody id="workers-table-body"></tbody>
    </table>
    <div class="paginate__menu" id="pagination-links"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    const tableBody = document.getElementById('workers-table-body');
    const paginationContainer = document.getElementById('pagination-links');

    async function loadWorkers(page = 1) {
        try {
            const response = await fetch(`/api/workers?page=${page}`);
            const data = await response.json();

            renderWorkers(data.workers.data);
            renderPagination(data.workers);
            currentPage = page;
        } catch (error) {
            console.error('Ошибка загрузки данных:', error);
            tableBody.innerHTML = '<tr><td colspan="5">Ошибка загрузки данных</td></tr>';
        }
    }

    function renderWorkers(workers) {
        tableBody.innerHTML = workers.map(worker => `
            <tr>
                <td class="name__worker" id="${worker.worker_id}">
                    ${worker.name}
                </td>
                <td>${worker.surname}</td>
                <td>${worker.position}</td>
                <td class="date_of_employment">${worker.hire_date}</td>
                <td>
                    <div class="action-buttons">
                        <input type="button" class="pokazat" onclick="showWorkerDetails(${JSON.stringify(worker).replace(/"/g, '&quot;')})" />

                        <form action="/api/workers/${worker.worker_id}" method="POST" class="delete-form">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="ydalit"></button>
                        </form>

                        <form action="/admin/workers/edit/${worker.worker_id}" method="GET">
                            <button type="submit" class="izmenit"></button>
                        </form>

                        <form action="/admin/workers/${worker.worker_id}/word" method="GET">
                            <button type="submit" class="MSWord"></button>
                        </form>
                    </div>
                </td>
            </tr>
        `).join('');

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ _method: 'DELETE' })
                        });

                        if(response.ok) {
                            loadWorkers(currentPage);
                        }
                    } catch (error) {
                        console.error('Ошибка удаления:', error);
                    }
            });
        });
    }

    function renderPagination(pagination) {
        let links = '';

        if(pagination.prev_page_url) {
            links += `<a href="#" onclick="loadPage(${pagination.current_page - 1})" class="page-link btn">&laquo; Назад</a> `;
        }

        if(pagination.next_page_url) {
            links += `<a href="#" onclick="loadPage(${pagination.current_page + 1})" class="page-link btn">Вперед &raquo;</a>`;
        }

        paginationContainer.innerHTML = links;
    }

    window.loadPage = function(page) {
        loadWorkers(page);
        return false;
    }

    loadWorkers(currentPage);
});

function showWorkerDetails(worker) {
    const educationText = worker.education ? "Имеется" : "Отсутствует";
    const detailsHtml = `
        <div class="window-info">
            <div><strong>ФИО:</strong> ${worker.surname} ${worker.name} ${worker.patronymic || ''}</div>
            <div><strong>Должность:</strong> ${worker.position}</div>
            <div><strong>Зарплата:</strong> ${worker.salary} руб.</div>
            <div><strong>Трудоустроен с:</strong> ${worker.hire_date}</div>
            <div><strong>Образование:</strong> ${educationText}</div>
            <div><strong>Номер телефона:</strong> ${worker.phone_number}</div>
            <div><strong>Электронная почта:</strong> ${worker.email}</div>
        </div>
    `;

    document.getElementById('workerDetails').innerHTML = detailsHtml;
    document.getElementById('myModal').style.display = "block";
}

function closeWindow() {
    document.getElementById('myModal').style.display = "none";
}
</script>
@endsection
