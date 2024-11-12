<p>Список пользователей в хранилище:</p>

<div class="table-responsive small">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">День рождения</th>
        {% if isAdmin %}
        <th scope="col">Редактирование</th>
        <th scope="col">Удаление</th>
        {% endif %}
      </tr>
    </thead>
    <tbody class="table_body">
      {% for user in users %}
      <tr>
        <td>{{ user.getUserId() }}</td>
        <td>{{ user.getUserName() }}</td>
        <td>{{ user.getUserLastName() }}</td>
        <td>{% if user.getUserBirthday() is not empty %}
          {{ user.getUserBirthday() | date('d.m.Y') }}
          {% else %}
          <b>Не задан</b>
          {% endif %}
        </td>
        {% if isAdmin %}
        <td scope="col"><a href="/user/updateForm/?id={{user.getUserId()}}">Изменить</a></td>
        <td scope="col"><button type="button" class="btn btn-primary btn-sm delete_button"
            id="{{user.getUserId()}}">Удаление</a></td>
        {% endif %}
      </tr>
      {% endfor %}
    </tbody>
  </table>
</div>
<script>
  const deleteButtons = document.querySelectorAll(".delete_button");
  console.log(deleteButtons);
  deleteButtons.forEach((deleteButton) => {
    deleteButton.onclick = function () {
      (async () => {
        const response = await fetch('/user/delete/',
          {
            method: 'post',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id=" + deleteButton.id
          }
        );
        const answer = await response.json();
        const tableBody = document.querySelector(".table_body");
        tableBody.innerHTML = '<div>dszfs</div>';

      })();
    }
  })


</script>