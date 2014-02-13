{% extends 'layout.tpl' %}

{% block pageContent %}
    <div class="row">
        <div class="col-xxs-10 col-xxs-offset-1 col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">

            {% if errors %}
                <div class="bs-callout bs-callout-danger">
                    <p>One or more errors were encountered:</p>
                    <ul>
                        {% for error in errors %}
                            <li>{{ error }}</li>
                        {% endfor %}
                    </ul>
                </div>
            {% endif %}

            <form action="./add.php" method="post" role="form" enctype="multipart/form-data">
                <div class="well">
                    <h2>Add Movie</h2>
                    <div class="form-group">
                        <label for="coverphoto">Cover</label>
                        <input class="filestyle" type="file" name="coverphoto" id="coverphoto" value="" autocomplete="off" placeholder="Select coverphoto" data-icon="false" data-classButtonContainerClass="input-group-btn" data-containerClass="input-group" />
                        <p class="help-block">Only .jpg, .png or .gif</p>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title" value="{{ title }}" autocomplete="off" placeholder="Title of the Movie" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input class="form-control" type="number" name="year" id="year" value="{% if year > 0 %}{{ year }}{% endif %}" autocomplete="off" placeholder="Year the movie was released" maxlength="4" />
                    </div>
                    <div class="form-group">
                        <label for="genre_id">Genre</label>
                        <select name="genre_id" id="genre_id" class="form-control">
                            <option value="0">Choose &hellip;</option>
                            {% if genres %}
                                {% for genre in genres %}
                                    <option value="{{ genre.id }}" {% if genre.id == genre_selected %} selected="selected"{% endif %}>{{ genre.title }}</option>
                                {% endfor %}
                            {% endif %}
                        </select>
                    </div>
                    <input type="hidden" name="moduleAction" value="add" />
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Add Movie</button>
                </div>
            </form>
        </div>
    </div>
{% endblock %}
