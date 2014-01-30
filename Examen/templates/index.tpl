{% extends 'layout.tpl' %}

{% block pageContent %}
    <!-- movies -->
    <section id="movies" class="row">
        {% if movies %}
            {% for movie in movies %}
                <article id="movie-{{ movie.id }}" class="movie col-xxs-12 col-xs-6 col-sm-4 col-md-3">
                    <a href="./files/covers/{{ movie.id }}.{{ movie.cover_extension }}" title="&ldquo;{{ movie.title }}&rdquo;, uploaded by {{ movie.username }} in {{ movie.genre }}"><img src="./files/covers/{{ movie.id }}.{{ movie.cover_extension }}" alt="&ldquo;{{ movie.title }}&rdquo;, uploaded by {{ movie.username }} in {{ movie.genre }}" title="&ldquo;{{ movie.title }}&rdquo;, uploaded by {{ movie.username }} in {{ movie.genre }}" class="img-responsive" /></a>
                </article>
            {% endfor %}
        {% else %}
            <p class="well">This genre contains no movies</p>

        {% endif %}
    </section>

    <!-- image modal ((ab)use bootstrap for lightbox) -->
    <div class="modal modal-wide fade" id="img-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">&hellip;</h4>
                </div>
                <div class="modal-body text-center">
                    <img src="" alt="" title="" style="max-width: 100%;" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
{% endblock %}
