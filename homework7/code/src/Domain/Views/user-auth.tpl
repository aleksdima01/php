{% if not auth_success %}
  {{ auth_error }}
 <p>Логин: admin</p>
<p>Пароль: geekbrains</p>
{% endif %}


<form action="/user/login/" method="post" >
  <input id="csrf_token" type="hidden"  name="csrf_token" value="{{ csrf_token }}">
  <p>
    <label for="user-login">Логин:</label>
    <input id="user-login" autocomplete="username" type="text" name="login">
  </p>
  <p>
    <label for="user-password">Пароль:</label>
    <input id="user-password" autocomplete="current-password" type="password" name="password">

  </p>
  <p><input type="submit" value="Войти"></p>
</form>