<?php
/**
 * User: Glenn
 * Date: 30/09/13
 */

$name = isset($_POST['name']) ? (string) $_POST['name'] : '';
$email = isset($_POST['email']) ? (string) $_POST['email'] : '';
$beroep = isset($_POST['beroep']) ? (int) $_POST['beroep'] : 0;
$via = isset($_POST['via']) ? (array) $_POST['via'] : array();
$remark = isset($_POST['remark']) ? (string) $_POST['remark'] : '';



?>

<html>
<head>
    <title>
        Opgave 4
    </title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h2>Waar heeft u ons bedrijf leren kennen?</h2>
    <dl>
        <dt><label for="name">Name</label> </dt>
        <dd><input type="text" name="name" id="name"value="<?php echo htmlentities($name); ?>"></dd>

        <dt><label for="email">Email</label> </dt>
        <dd><input type="text" name="email" id="email"value="<?php echo htmlentities($email); ?>"></dd>

        <dt><label for="beroep">Beroep</label> </dt>
        <dd>
            <select name="beroep" id="beroep">
                <option value="0"<?php if ($beroep === 0) { echo ' selected="selected"'; } ?>>Please select...</option>
                <option value="1"<?php if ($beroep === 1) { echo ' selected="selected"'; } ?>>Dingen doen</option>
                <option value="2"<?php if ($beroep === 2) { echo ' selected="selected"'; } ?>>Niets doen</option>
                <option value="3"<?php if ($beroep === 3) { echo ' selected="selected"'; } ?>>Beeke doen</option>
            </select>
        </dd>

        <dt><label>Find via</label></dt>
        <dd>
            <label for="meal0"><input type="checkbox" name="via[]" id="via0" value="Internet"<?php if (in_array('Internet', $via)) { echo ' checked="checked"'; } ?> />Internet</label>
            <label for="meal1"><input type="checkbox" name="via[]" id="via1" value="Vrienden"<?php if (in_array('Vrienden', $via)) { echo ' checked="checked"'; } ?> />Vrienden</label>
            <label for="meal2"><input type="checkbox" name="via[]" id="via2" value="Advertenties"<?php if (in_array('Advertenties', $via)) { echo ' checked="checked"'; } ?> />Advertenties</label>
            <label for="meal2"><input type="checkbox" name="via[]" id="via3" value="Andere"<?php if (in_array('Andere', $via)) { echo ' checked="checked"'; } ?> />Andere</label>
        </dd>

        <dt><label for="remark">Remark</label></dt>
        <dd><textarea name="remark" id="remark" rows="5" cols="40"><?php echo htmlentities($remark); ?></textarea>
        </dd>
        <dt>
            <input type="submit" value="Send" />
        </dt>
    </dl>
</form>

</body>

</html>