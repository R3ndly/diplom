@extends('layouts.app')
@section('title')Страница сотрудников@endsection
@section('content')
<form action="{{ route('admin.vacancies.index') }}" method="GET" style="display: inline-block; float: left; padding-left: 20px;">
    @csrf
    <button type="submit" class="back-to-index"></button>
</form>

<div class="container">
    <div class="about_vacancy">
        <h1>Подробная информация о вакансии <strong>{{ $vacancy->title }}</strong></h1><br>

        <h3>О вакансии:</h3>
        <p>Должность: {{ $vacancy->department }}</p>
        <p>{{ $vacancy->description }}</p><br>

        <h3>Условия:</h3>
        <p>Формат работы: {{ $vacancy->location }}, {{ $vacancy->type }}.</p>
        <p>Зарплата: {{ $vacancy->salary }} руб.</p>

        <h4>Если вы заинтересованны в работе у нас, просим откликнуться на один из слудующих способов связи:</h4>
        <p>Почта: {{ $vacancy->contact_email }}</p>
        <p>Телефон: {{ $vacancy->contact_phone }}</p>

        <p class="publication" style="text-align: right;">Дата публикации вакансии -> {{ $date }}</p>
    </div>
</div>
@endsection