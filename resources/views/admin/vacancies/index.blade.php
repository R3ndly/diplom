@extends('layouts.app')
@section('title')Страница сотрудников@endsection
@section('content')

<div class="vacancies-page">
    <h1 class="text-center">Хотите работать у нас?</h1><br>

    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('admin.vacancies.create') }}">Добавить вакансию</a>
    </div><br><br>

    <div class="container vacancies-container">
        @foreach ($vacancies as $vacancy)
            <div class="vacancies_block">
                <h3>{{ $vacancy->title }}</h3><br>
                <p class="description">
                    {{ Str::limit($vacancy->description, 150) }}
                    @if (strlen($vacancy->description) > 190)
                        <a href="{{ route('admin.vacancies.show', $vacancy->vacancy_id) }}">Подробнее</a>
                    @endif
                </p><br>

                <p>Место работы: {{ $vacancy->location }}</p>
                <p>Оклад: {{ $vacancy->salary }} руб.</p>
                <a href="{{ route('admin.vacancies.edit', $vacancy->vacancy_id) }}" class="">Редактировать</a>
                <div class="button_in_vacancies_block">
                    <a href="{{ route('admin.vacancies.show', $vacancy->vacancy_id) }}" class="btn btn-info">Подробнее</a>
                    <form action="{{ route('admin.vacancies.destroy', $vacancy->vacancy_id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-info">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <div class="paginate__menu">{{ $vacancies->links() }}</div>
</div>
@endsection
