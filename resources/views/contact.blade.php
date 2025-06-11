@extends('layouts.app')
@section('styles')
    @vite(['resources/css/contact.css'])
@endsection
@section('title')О мастерской Золотой Оттенок@endsection
@section('content')

<h4 class="text-center">Наше прекрасное руководство</h4><br>

<div class="container">
    <div class="photo-grid">
        <div class="rows">
            <div class="row">
                <div class="column">
                    <div class="photo-item" style="background-image: url('{{ asset('img/zamdir.jpg') }}');">
                        <div class="overlay">
                            <h2>Семенчук Вячеслав Григорьевич</h2>
                            <p style="opacity: 0.65;">Старший Аналитик</p>
                            <div class="social-links">
                                <img alt="facebook" src="./img/facebook 1.png">
                                <img alt="instagram" src="./img/instagram 1.png">
                                <img alt="linkedin" src="./img/linkedin 1.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="photo-item" style="background-image: url('{{ asset('img/secret.jpg') }}');">
                        <div class="overlay">
                            <h2>Вяземский Александр Юрьевич</h2>
                            <p style="opacity: 0.65;">Старший маркетолог</p>
                            <div class="social-links">
                                <img alt="facebook" src="./img/facebook 1.png">
                                <img alt="instagram" src="./img/instagram 1.png">
                                <img alt="linkedin" src="./img/linkedin 1.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="photo-item" style="background-image: url('{{ asset('img/zambyh.jpg') }}');">
                        <div class="overlay">
                            <h2>Бакальчук Андрей Валерьевич</h2>
                            <p style="opacity: 0.65;">Ответственный за отдел разработки</p>
                            <div class="social-links">
                                <img alt="facebook" src="./img/facebook 1.png">
                                <img alt="instagram" src="./img/instagram 1.png">
                                <img alt="linkedin" src="./img/linkedin 1.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row"> 
                <div class="column">
                    <div class="photo-item" style="background-image: url('{{ asset('img/byh.jpg') }}');">
                        <div class="overlay">
                            <h2>Смирнова Валентина Витальевна</h2>
                            <p style="opacity: 0.65;">Директор</p>
                            <div class="social-links">
                                <img alt="facebook" src="./img/facebook 1.png">
                                <img alt="instagram" src="./img/instagram 1.png">
                                <img alt="linkedin" src="./img/linkedin 1.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="photo-item" style="background-image: url('{{ asset('img/Дизайнер.webp') }}');">
                        <div class="overlay">
                            <h2>Лебедев Александр Максимович</h2>
                            <p style="opacity: 0.65;">Главный Дизайнер</p>
                            <div class="social-links">
                                <img alt="facebook" src="./img/facebook 1.png">
                                <img alt="instagram" src="./img/instagram 1.png">
                                <img alt="linkedin" src="./img/linkedin 1.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="photo-item" style="background-image: url('{{ asset('img/ТехЛИД.jpg') }}');">
                        <div class="overlay">
                            <h2>Калинин Егор Артёмович</h2>
                            <p style="opacity: 0.65;">ТехЛид</p>
                            <div class="social-links">
                                <img alt="facebook" src="./img/facebook 1.png">
                                <img alt="instagram" src="./img/instagram 1.png">
                                <img alt="linkedin" src="./img/linkedin 1.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            <div class="about__map mt-4">
                <p>Наши физические точки находятся по следующим адресам:</p>
                <p>г.Иркутск, Свердловский округ, кв.43, дом 13<br />г.Иркутск, Свердловский округ, кв.29, дом 11</p><br />
                <p class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d78109.94496961955!2d104.26330920022136!3d52.28086785441388!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1709458100782!5m2!1sru!2sru" style="border:0;" allowfullscreen="" loading=“lazy” referrerpolicy=“no-referrer-when-downgrade”></iframe></p><br />
                <p>Телефон горячей линии: +79041531818</p>  
            </div>
    </div>
</div>

@endsection
