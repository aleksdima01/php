<!DOCTYPE html>
<html>
    <head>
        <title>{{ title }}</title>
        <link rel="stylesheet" href="http://mysite.local:8081/style.css?14">
    </head>
    <body>
        <div id="header">
            {% include "auth-template.tpl" %}
        </div>
        <div id="menu">
            <a href="/">Главная</a>
            <a href="/user">Пользователи</a>
            <a href="/user/add">Добавить пользователя</a>
        </div>
        {% include content_template_name %}
    </body>
</html>