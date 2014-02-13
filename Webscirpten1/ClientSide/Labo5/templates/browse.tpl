<!DOCTYPE html>
<html>
<head>
	<title>Contacten</title>
	<link rel="stylesheet" href="css/styles.css" />
	<link rel="stylesheet" href="_lib/css/forms.css" />
</head>
<body>
	<header>
		<h2>Contacten overzicht</h2>
	</header>
	<section id="filters">
		<form action="#">
			<dl>
				<dt><label for="txtSearch">Zoek op tekst: </label></dt>
				<dd><input type="text" id="txtSearch" name="txtSearch" /></dd>
				<dt><label>Toon: </label></dt>
				<dd>
					<a href="#" id="lnkAll" class="active">iedereen</a> (<span id="numAll">0</span>) &mdash; 
					<a href="#" id="lnkFamily">familie</a> (<span id="numFamily">0</span>) &mdash; 
					<a href="#" id="lnkFriends">vrienden</a> (<span id="numFriends">0</span>) &mdash; 
					<a href="#" id="lnkColleagues">collega's</a> (<span id="numColleagues">0</span>) &mdash; 
					<a href="#" id="lnkOther">andere</a> (<span id="numOther">0</span>)
				</dd>
			</dl>
		</form>
	</section>
	<div id="content" class="clearfix">
		<div class="add">
			+ <a href="insert.php">nieuw contact</a>...
		</div>    
{iteration:iContacts}
		<article class="contact {$role|htmlentities} clearfix" id="contact_{$id}">
			<h1>{$name}</h1>
			<a href="#"><img src="files/avatars/avatar_{$id}.jpg" alt="{$name|htmlentities}" class="thumb" /></a>
			<ul class="menu">
				<li>&gt; <a href="#">bewerken</a>...</li>
				<li>&gt; <a href="#">verwijderen</a>...</li>
			</ul>
			<p class="toolbar">
				<a href="#" class="comments tooltip"><img src="images/icons/info.gif" alt="icon comments" /><span>{$comments|htmlentities}</span></a>
				<a href="mailto:{$email|htmlentities}" title="email versturen" class="lnkmail"><img src="images/icons/mail.png" alt="icon mail" /></a>
			</p>
			<div class="searchstring">{$searchstring|htmlentities}</div>
		</article>
{/iteration:iContacts}
	</div>
	<footer>
		<p>Clientside Webscripting 1, 2012</p>
	</footer>
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
