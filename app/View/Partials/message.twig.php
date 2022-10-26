{% extends 'Partials/body.twig.php'  %}

{% block title %}{{titulo}} - Blog Alpha{% endblock %}

{% block body %}
<div>

    <h1>{{titulo}}</h1>
    <hr>
    <p>{{description}}</p>
    {% if link != null %}
    <a href="{{link}}">Voltar</a>
    {% endif %}
</div>
{% endblock %}
