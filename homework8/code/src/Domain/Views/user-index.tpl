<p>Список пользователей в хранилище:</p>
<ul id="navigation">
    {% for user in users %}
        <li>{{ user.getUserName() }} {{ user.getUserLastName() }}. День рождения: {{ user.getUserBirthday() | date('d.m.Y') }} <a href="/user/updateForm/?id={{user.getUserId()}}">Изменить</a> <a href="/user/delete/?id={{user.getUserId()}}">Удалить</a></li>
    {% endfor %}
</ul>