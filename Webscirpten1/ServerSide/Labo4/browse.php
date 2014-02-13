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

$what = isset($_POST['what']) ? $_POST['what'] : ''; // The todo that was sent in via the form
$priority = isset($_POST['priority']) ? $_POST['priority'] : 'low'; // The priority that was sent in via the form
$collection = '';


/**
 * Handle action 'add' (user pressed add button)
 * ----------------------------------------------------------------
 */
if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'add')) {

    // check parameters
    if ($what == '')array_push($formErrors, 'No todo item was typed');
    if (!in_array($priority, $priorities)) array_push($formErrors, 'There was an error with the priority please try again');

    // if succesfull
    if(empty($formErrors)) {
        try {
            // insert into database
            $stmt = $db->prepare('INSERT INTO todolist (what, priority, added_on) VALUES (:what, :priority, :added_on);');
            $stmt->bindValue(':what', $what, PDO::PARAM_STR);
            $stmt->bindValue(':priority', $priority, PDO::PARAM_STR);
            $stmt->bindValue(':added_on', (new DateTime())->format('Y-m-d'), PDO::PARAM_STR);
            $stmt->execute();

            header('location:'.$_SERVER['PHP_SELF']);
            exit();
        } catch (Exception $e) {
            showDbError('fetch', $e);
        }
    }

}


/**
 * No action to handle: show our page itself
 * ----------------------------------------------------------------
 */
// Fetch needed data from DB
try {
    $stmt = $db->prepare('SELECT * FROM  todolist ORDER BY priority ASC');
    $stmt->execute();
    if ($stmt)
        $collection = $stmt->fetchAll(PDO::FETCH_ASSOC);
    else
        showDbError('fetch', 'data could not be fetched');
} catch(Exception $e) {
    showDbError('db', $e->getMessage());
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
                                    foreach ($priorities as $prior)
                                        echo ('<option value="'.$prior.'">'.$prior.'</option>');
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
        if ($formErrors != '')
            foreach($formErrors as $error)
                echo (' <div class="box" id="boxError"><ul class="errors">'.$error.'</ul></div>');

        ?>

        <div class="box" id="boxYourTodos">

            <h2>Your todos</h2>

            <div class="boxInner">
                <ul>
                    <?php
                    if ($collection != ''){
                        foreach($collection as $item){
                            echo'<li id="item-'.htmlentities($item['id']).'" class="item '.htmlentities($item['priority']).' clearfix">
                                <a href="delete.php?id='.htmlentities($item['id']).'" class="delete" title="Delete/Complete this item">delete/complete</a>
                                <a href="edit.php?id='.htmlentities($item['id']).'" class="edit" title="Edit this item">edit</a>
                                <span>'.htmlentities($item['what']).'</span>
                            </li>';
                        }
                    }else {
                        ?>
                        <<li class="item high clearfix">No items in DB</li>
                    <?php } ?>
                </ul>
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