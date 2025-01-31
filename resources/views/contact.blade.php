@extends('layouts.app')
@section('title')О мастерской Золотой Оттенок@endsection
@section('content')

<h4 class="text-center">Наши контакты для связи</h4><br><br>

    <div class="container">
        <div class="photo-grid">
            <div class="photo-item" style="background-image: url('{{ asset('img/zamdir.jpg') }}');">
                <div class="overlay">
                    <h2 style="font-size: 16px;">Семенчук Вячеслав Григорьевич</h2>
                    <p style="opacity: 0.65;">Старший Аналитик</p>
                    <div class="social-links">
                        <img alt="facebook" src="./img//facebook 1.png">
                        <img alt="instagram" src="./img/instagram 1.png">
                        <img alt="linkedin" src="./img/linkedin 1.png">
                    </div>
                </div>
            </div>
            <div class="photo-item" style="background-image: url('{{ asset('img/secret.jpg') }}');">
                <div class="overlay">
                    <h2 style="font-size: 16px;">Вяземский Александр Юрьевич</h2>
                    <p style="opacity: 0.65;">Старший Разработчик клинентской части</p>
                    <div class="social-links">
                        <img alt="facebook" src="./img//facebook 1.png">
                        <img alt="instagram" src="./img/instagram 1.png">
                        <img alt="linkedin" src="./img/linkedin 1.png">
                    </div>
                </div>
            </div>
            <div class="photo-item" style="background-image: url('{{ asset('img/zambyh.jpg') }}');">
                <div class="overlay">
                    <h2 style="font-size: 16px;">Бакальчук Андрей Валерьевич</h2>
                    <p style="opacity: 0.65;">Старший Разработчик серверной части</p>
                    <div class="social-links">
                        <img alt="facebook" src="./img//facebook 1.png">
                        <img alt="instagram" src="./img/instagram 1.png">
                        <img alt="linkedin" src="./img/linkedin 1.png">
                    </div>
                </div>
            </div>
            <div class="photo-item" style="background-image: url('{{ asset('img/byh.jpg') }}');">
                <div class="overlay">
                    <h2 style="font-size: 16px;">Смирнова Валентина Александровна</h2>
                    <p style="opacity: 0.65;">Директор</p>
                    <div class="social-links">
                        <img alt="facebook" src="./img//facebook 1.png">
                        <img alt="instagram" src="./img/instagram 1.png">
                        <img alt="linkedin" src="./img/linkedin 1.png">
                    </div>
                </div>
            </div>
            <div class="photo-item" style="background-image: url('{{ asset('img/Дизайнер.webp') }}');">
                <div class="overlay">
                    <h2 style="font-size: 17px;">Лебедев Александр Александрович</h2>
                    <p style="opacity: 0.65;">Главный Дизайнер</p>
                    <div class="social-links">
                        <img alt="facebook" src="./img//facebook 1.png">
                        <img alt="instagram" src="./img/instagram 1.png">
                        <img alt="linkedin" src="./img/linkedin 1.png">
                    </div>
                </div>
            </div>
            <div class="photo-item" style="background-image: url('{{ asset('img/ТехЛИД.jpg') }}');">
                <div class="overlay">
                    <h2 style="font-size: 16px;">Калинин Егор Артёмович</h2>
                    <p style="opacity: 0.65;">ТехЛид</p>
                    <div class="social-links">
                        <img alt="facebook" src="./img//facebook 1.png">
                        <img alt="instagram" src="./img/instagram 1.png">
                        <img alt="linkedin" src="./img/linkedin 1.png">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
