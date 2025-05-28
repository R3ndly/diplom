# Подробная документация api

Если в адресной строке перейти по пути `/swagger` то вы попадёте на страницу документации api. </br>
<p align="center">
    <img  src="https://github.com/R3ndly/diplom/blob/main/public/img/swagger1.png"/>
</p>

Для доступа к некоторым api маршрутам необходимо зарегистрироваться, т.е. получить `bearer token` и вставить его в окно авторизации: </br>
<p align="center">
    <img  src="https://github.com/R3ndly/diplom/blob/main/public/img/swagger2.png"/>
</p>

Получить `bearer token` можно при **регистрации или авторизации**. При авторизации нужно отправить данные для входа к `/api/login` эндпоинту: </br>
<p align="center">
    <img  src="https://github.com/R3ndly/diplom/blob/main/public/img/swagger3.png"/>
    <img  src="https://github.com/R3ndly/diplom/blob/main/public/img/swagger4.png"/>
</p>


На примере выше мы получили `bearer token` такого вида: `139|RU6fY793UTJkrskI8zo2eaQtISkAuFcRN82yUQCS45ea0747`. </br>
Его и нужно вставить в окно авторизации, чтобы все api запросы, выполняющиеся с помощью curl были с заголовком `-H 'Authorization: Bearer 139|RU6fY793UTJkrskI8zo2eaQtISkAuFcRN82yUQCS45ea0747' \`.

Запрос на получение JSON файла из таблицы Vacanсies: </br>
<p align="center">
    <img  src="https://github.com/R3ndly/diplom/blob/main/public/img/swagger5.png"/>
</p>

