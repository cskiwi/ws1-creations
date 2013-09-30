<?php
/**
 * User: Glenn
 * Date: 30/09/13
 */

?>
<html>
<head>
    <title>
        Opgave 1
    </title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">

        <fieldset>
            <dl>
                <dt><label for="first">First textfield</label> </dt>
                <dd><input type="text" name="first" id="first"></dd>
                <dt><label for="second">Second textfield</label></dt>
                <dd><input type="text" name="second" id="second" value="<?php echo htmlentities(isset($_GET['first']) ? $_GET['first'] : '') ?>"></dd>

                <dt><input type="submit" value="Send"></dt>
            </dl>
        </fieldset>
    </form>

</body>

</html>