<!DOCTYPE html>
<html lang="en">
<head>

    <title>The Movies</title>

    <meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/bootstrap.xxs.css" rel="stylesheet">
    <link href="./css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body>
{% block header %}
    <!-- header -->
    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="./index.php">All</a></li>
                    {% if genres %}
                        {% for genre in genres %}
                            <li><a href="./index.php?genre={{ genre.id }}">{{ genre.title }}</a></li>
                        {% endfor %}
                    {% endif %}
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    {% if user %}
                        <li><a href="add.php">Add Movie</a></li>
                        <li><a href="logout.php">Sign out ({{ user }})</a></li>
                    {% else %}
                        <li><a href="./login.php">Sign in</a></li>
                    {% endif %}
                </ul>
            </div>
        </div>
    </div>
{% endblock %}

<!-- content -->
<div class="container">
    {% block pageContent %}
        <p>This should never be displayed!</p>
    {% endblock %}
</div>

{% block pageFooter %}
    <!-- footer -->
    <footer id="footer">
        <div class="container">
            <p>&copy; 2014, <a href="http://www.ikdoeict.be/" title="IkDoeICT.be">IkDoeICT.be</a></p>
        </div>
    </footer>

    <script src="./js/jquery-2.1.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/index.js"></script>
{% endblock %}
</body>
</html>