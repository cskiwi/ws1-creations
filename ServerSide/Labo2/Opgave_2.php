<?php
/**
 * User: Glenn
 * Date: 30/09/13
 */
$rand1 = isset($_GET['first']) ? $_GET['first'] : rand (0, 10);
$rand2 = isset($_GET['second']) ? $_GET['second'] : rand (0, 10);

$sum = $rand1 + $rand2;
?>

<html>
<head>
    <title>
        Opgave 2
    </title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">

    <dl>
        <dt><label for="first">First textfield</label> </dt>
        <dd><input type="text" name="first" id="first"value="<?php echo htmlentities($rand1) ?>"></dd>
        <dt><label for="second">Second textfield</label></dt>
        <dd><input type="text" name="second" id="second" value="<?php echo htmlentities($rand2) ?>"></dd>
        <dt><label for="third">Sum</label></dt>
        <dd><input type="text" id="third" value="<?php echo (isset($_GET['first']) && isset($_GET['second']))? htmlentities($sum) : ''; ?>" <?php echo (isset($_GET['first']) && isset($_GET['second']))?: 'disabled'; ?>></dd>
        <dt><input type="submit" value="Send"></dt>
    </dl>

</form>

</body>

</html>