<!DOCTYPE html>
<html>

<head>
    <title>{{ title }}</title>
    <link rel="stylesheet" href="style.css?14">
</head>

<body>
    <header class="header">
        {% include "header.tpl" %}
    </header>
    {% include content_template_name %}
    <footer>
        {% include "footer.tpl" %}
    </footer>

</body>

</html>