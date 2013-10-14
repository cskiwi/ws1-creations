<?php

	/**
	 * Includes
	 * ----------------------------------------------------------------
	 */


		// config & functions
		require_once 'includes/config.php';
		require_once 'includes/functions.php';


	/**
	 * Database Connection
	 * ----------------------------------------------------------------
	 */

		// @TODO database connection


	/**
	 * Initial Values
	 * ----------------------------------------------------------------
	 */


		$priorities = array('low','normal','high'); // The possible priorities of a todo
		$formErrors = array(); // The encountered form errors

		$what = isset($_POST['what']) ? $_POST['what'] : ''; // The todo that was sent in via the form
		$priority = isset($_POST['priority']) ? $_POST['priority'] : 'low'; // The priority that was sent in via the form


	/**
	 * Handle action 'add' (user pressed add button)
	 * ----------------------------------------------------------------
	 */

		if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'add')) {

			// check parameters

				// @TODO (if an error was encountered, add it to the $formErrors array)

			// if no errors: insert values into database

				// @TODO insert into database

			// if query succeeded: redirect to this very same page

				// @TODO redirect to same page

		}


	/**
	 * No action to handle: show our page itself
	 * ----------------------------------------------------------------
	 */

		// Fetch needed data from DB

			// @TODO get all todo items from databases



?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="oldie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="oldie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="oldie ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

	<title>Todolist</title>

	<meta charset="UTF-8" />
	<meta name="viewport" content="width=520" />
	<meta http-equiv="cleartype" content="on" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<link rel="stylesheet" media="screen" href="css/reset.css" />
	<link rel="stylesheet" media="screen" href="css/screen.css" />

	<script src="js/browse.js"></script>

</head>
<body>

	<div id="siteWrapper">

		<!-- header -->
		<header>
			<h1><a href="index.php">Todolist</a></h1>
		</header>

		<!-- content -->
		<section>

			<div class="box" id="boxAddTodo">

				<h2>Add new todo</h2>

				<div class="boxInner">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<fieldset>
							<dl class="clearfix columns">
								<dd class="column column-46"><input type="text" name="what" id="what" value="" /></dd>
								<dd class="column column-16" id="col-priority">
									<select name="priority" id="priority">
<?php
	// @TODO loop priorities and show them as options in the select. Be sure to persist the value
?>
									</select>
								</dd>
								<dd class="column column-16" id="col-submit">
									<label for="btnSubmit"><input type="submit" id="btnSubmit" name="btnSubmit" value="Add" /></label>
									<input type="hidden" name="moduleAction" id="moduleAction" value="add" />
								</dd>
							</dl>
						</fieldset>
					</form>
				</div>

			</div>

<?php
	// @TODO if any errors are set, show them inside <div class="box" id="boxError"><ul class="errors">...</ul></div>
?>

			<div class="box" id="boxYourTodos">

				<h2>Your todos</h2>

				<div class="boxInner">

<?php
	// @TODO if any todoitems are found, show them inside <ul></ul> using the struct below
	/*
		<li id="item-{$iId}" class="item {$iPriority} clearfix">
			<a href="delete.php?id={$iId}" class="delete" title="Delete/Complete this item">delete/complete</a>
			<a href="edit.php?id={$iId}" class="edit" title="Edit this item">edit</a>
			<span>{$iWhat}</span>
		</li>
	*/
	// @TODO if no todoitems are found, show a userfriendly message
?>
				</div>

			</div>

		</section>

		<!-- footer -->
		<footer>
			<p>&copy; 2013, <a href="http://www.ikdoeict.be/" title="IkDoeICT.be">IkDoeICT.be</a></p>
		</footer>

	</div>

</body>
</html>