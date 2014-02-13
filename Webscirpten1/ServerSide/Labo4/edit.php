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

include_once 'includes/connection.php';


/**
 * Initial Values
 * ----------------------------------------------------------------
 */


$priorities = array('low','normal','high'); // The possible priorities of a todo
$formErrors = array(); // The encountered form errors

$id_get = isset($_GET['id']) ? (int) $_GET['id'] : 0; // The passed in id of the todo
$id_post = isset($_POST['id']) ? (int) $_POST['id'] : 0; // The todo id that was sent in via the form
$what = isset($_POST['what']) ? $_POST['what'] : ''; // The todo that was sent in via the form
$priority = isset($_POST['priority']) ? $_POST['priority'] : 'low'; // The priority that was sent in via the form


/**
 * Handle action 'edit' (user pressed edit button)
 * ----------------------------------------------------------------
 */

if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'edit')) {
    // check if item exists (use the id from the $_POST array!)
    if ($id_post == 0)
        array_push($formErrors, 'no or wrong id was given!');
    else {
        try {
            // check if ID excists
            $stmt = $db->prepare('SELECT * FROM todolist WHERE id = :ID;');
            $stmt->bindValue(':ID', $id_post, PDO::PARAM_INT);
            $stmt->execute();
            $item = $stmt->fetch();
            if ($item != null) {
                if (trim($what) === '') array_push($formErrors,'fill in the todo');
                if (!in_array($priority, $priorities))array_push($formErrors, 'There was an error with the priority please try again');
                if (empty($formErrors)) {
                    echo 'updating';
                    $stmt = $db->prepare('UPDATE todolist SET what=:what,priority=:priority WHERE id = :ID;');
                    $stmt->bindValue(':ID', $id_post, PDO::PARAM_INT);
                    $stmt->bindValue(':what', $what, PDO::PARAM_STR);
                    $stmt->bindValue(':priority', $priority, PDO::PARAM_STR);
                    $stmt->execute();
                    header('location:browse.php');
                    exit();
                } else {
                    // error in post, pass the id to the form for re-getting original data
                    $id_get = $id_post;
                }
            } else {
                header('location:browse.php');
                exit();
            }
        } catch (Exception $e) {
            showDbError('fetch', $e);
        }
    }
}


/**
 * No action to handle: show edit page
 * ----------------------------------------------------------------
 */

// header('location:'.$_SERVER['PHP_SELF']);
if ($id_get == 0)
    array_push($formErrors, 'no or wrong id was givven');
else {
    try {
        // check if ID excists
        $stmt = $db->prepare('SELECT * FROM todolist WHERE id = :ID;');
        $stmt->bindValue(':ID', $id_get, PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch();
        if ($item != null) {
            $what = $item['what'];
            $priority = $item['priority'];
        } else {
            header('location:browse.php');
        }

    } catch (Exception $e) {
        showDbError('fetch', $e);
    }
}

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

    <script src="js/edit.js"></script>

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

            <h2>Edit existing todo</h2>
            <div class="boxInner">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <dl class="clearfix columns">
                            <dd class="column column-46"><input type="text" name="what" id="what" value="<?php echo htmlentities($what); ?>" /></dd>
                            <dd class="column column-16" id="col-priority">
                                <select name="priority" id="priority">
                                    <?php
                                    foreach ($priorities as $prior){
                                    echo ('<option value="'.$prior.'" ');
                                    if($priority == $prior)
                                    echo 'selected';
                                    echo (' >'.$prior.'</option>');
                                    }
                                    ?>
                                </select>
                            </dd>
                            <dd class="column column-16" id="col-submit">
                                <label for="btnSubmit"><input type="submit" id="btnSubmit" name="btnSubmit" value="Edit" /></label>
                                <input type="hidden" name="id" value="<?php echo htmlentities($id_get); ?>" />
                                <input type="hidden" name="moduleAction" id="moduleAction" value="edit" />
                            </dd>
                        </dl>
                    </fieldset>
                </form>
                <p class="cancel">or <a href="index.php" title="Cancel and go back">Cancel and go back</a></p>
            </div>

        </div>

        <?php
        if ($formErrors != '')
        foreach($formErrors as $error)
        echo (' <div class="box" id="boxError"><ul class="errors">'.$error.'</ul></div>');

        ?>

    </section>

    <!-- footer -->
    <footer>
        <p>&copy; 2013, <a href="http://www.ikdoeict.be/" title="IkDoeICT.be">IkDoeICT.be</a></p>
    </footer>

</div>

</body>
</html>