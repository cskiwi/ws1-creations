<?php
/**
 * User: Glenn
 * Date: 30/09/13
 */
$selected = isset($_GET['mem'])? $_GET['mem'] : null;
$prijzen = array(
    '4GB' => 45,
    '8GB' => 54,
    '16GB' => 109);

?>

<html>
<head>
    <title>
        Opgave 3
    </title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">

    <dl>
        <dt><label>Memory options</label> </dt>
        <dd><label for="radio_4gb"><input type="radio" name="mem" id="radio_4gb" value="4GB" <?php if ($selected == '4GB') echo 'checked="checked"'; ?> />4GB (&euro; 45)</label></dd>
        <dd><label for="radio_8gb"><input type="radio" name="mem" id="radio_8gb" value="8GB" <?php if ($selected == '8GB') echo 'checked="checked"'; ?> />8GB (&euro; 54)</label></dd>
        <dd><label for="radio_16gb"><input type="radio" name="mem" id="radio_16gb" value="16GB" <?php if ($selected == '16GB') echo 'checked="checked"'; ?> />16GB (&euro; 109)</label></dd>

        <dt><input type="submit" value="Send"></dt>
    </dl>

    <?php
    if ($selected != null)
        echo 'De prijs is ' . $prijzen[$selected] . ' euro';
    ?>
</form>

</body>

</html>