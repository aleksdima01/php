<!DOCTYPE html>
<html class="h-100">

<head>
  <title>{{ title }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="http://mysite.local:8081/style.css?15">
</head>

<body class="d-flex flex-column h-100">
  <div class="container">
    <header
      class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 link-secondary">Главная</a></li>
        <li><a href="/user/index/" class="nav-link px-2 link-dark">Пользователи</a></li>
        <li><a href="/user/add" class="nav-link px-2 link-dark">Добавить пользователя</a></li>
      </ul>

      {% include "auth-template.tpl" %}
    </header>
  </div>

  <main class="flex-shrink-0">
    <div class="container content-template">
      {% include content_template_name %}
    </div>
  </main>

  <footer class="footer mt-auto py-3 bg-light">
    <div class="container d-flex justify-content-between">
      <span class="text-muted">Created at 11.2024</span>
      <p id="server_time"></p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <script>
    // на Ajax

    // setInterval(() => {
    //   $.ajax({
    //     method: 'GET',
    //     url: "time/index",
    //   }).done(function (response) {
    //     let time = $.parseJSON(response);
    //     $('#server_time').text(time.time);
    //   })
    // }, 1000);

    // на чистом JS
    setInterval(() => {
      (async () => {
        const response = await fetch('/time/index');
        const answer = await response.json();
        document.querySelector('#server_time').textContent = answer.time;
      })()
    }, 1000)
  </script>
</body>

<!-- <a href="/user/delete/?id={{user.getUserId()}}">Удалить</a> -->

</html>