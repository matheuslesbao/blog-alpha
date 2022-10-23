<!DOCTYPE HTML>
<html>

<head>
    <title>{% block title %}{% endblock %}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{BASE}}public/assets/css/main.css" />
</head>

<body class="is-preload">
    {% include 'Partials/header.twig.php' %}

    {% block body%}{% endblock%}

</body>

</html>
