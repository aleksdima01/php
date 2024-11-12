<form action="/user/update/?id={{id}}" method="post">
  <input id="csrf_token" type="hidden" name="csrf_token" value="{{ csrf_token }}">
  <p>
    <label for="user-name">Имя:</label>
    <input id="user-name" type="text" name="name" value="{{users_name}}" placeholder="Имя">
  </p>
  <p>
    <label for="user-lastname">Фамилия:</label>
    <input id="user-lastname" type="text" name="lastname" value="{{user_lastname}}" placeholder="Фамилия">
  </p>
  <p>
    <label for="user-birthday">День рождения:</label>
    <input id="user-birthday" type="text" name="birthday"value="{{user_birthday | date('d-m-Y')}}" placeholder="ДД-ММ-ГГГГ">
  </p>
  <p><input class="btn btn-primary" type="submit" value="Сохранить"></p>
</form>