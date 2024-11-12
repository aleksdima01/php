{% if not user_authorized %}
 <div class="col-md-3 text-end">
    <a href="/user/auth/" class="btn btn-primary">Вход в систему</a>
     </div>
{% else %}
<div class="col-md-3 col-md-auto mb-md-0 me-2">
    Добро пожаловать на сайт, {{user_name}}!     
</div>
<a href="/user/logout/" class="btn btn-primary">Выйти из системы</a>
 
{% endif %}