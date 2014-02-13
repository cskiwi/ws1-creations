<?php
/**
 * User: Glenn
 * Date: 30/09/13
 */

$name = isset($_POST['name']) ? (string) $_POST['name'] : '';
$email = isset($_POST['email']) ? (string) $_POST['email'] : '';
$profession = isset($_POST['profession']) ? (int) $_POST['profession'] : 0;
$via = isset($_POST['via']) ? (array) $_POST['via'] : array();
$remark = isset($_POST['remark']) ? (string) $_POST['remark'] : '';


$msgName = '*';
$msgEmail = '*';
$msgprofession = '*';
$msgVia = '*';
$msgRemark = '';

if (isset($_POST['btnSubmit'])) {
    $allOk = true;

    // name
    if (trim($name) === '') {
        $msgName = 'Please enter your name';
        $allOk = false;
    }

    // Email
    if (trim($email) === '') {
        $msgEmail = 'Please enter your email';
        $allOk = false;
    }

    // profession
    if ($profession == 0) {
        $msgprofession = 'Please select a profession';
        $allOk = false;
    }

    // Via
    if($via == array()){
        $msgVia = 'Please select one or more options how you\'ve found us';
        $allOk = false;
    }

    // Remark
    /*
    if(trim($remark) == ''){
        $msgRemark = 'Please enter a remark';
        $allOk = false;
    }*/


    if ($allOk === true) {
        header('Location: Opgave_5b.php?name=' . urlencode($name) . '&email=' .urlencode($email) . '&profession=' . urlencode($profession) . '&via=' . urlencode(implode(',',$via)) . '&remark=' . urlencode($remark));
    }
}


?>

<html>
<head>
    <meta charset="UTF-8" />
    <title>
        Opgave 5
    </title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h2>Waar heeft u ons bedrijf leren kennen?</h2>
    <dl>
        <dt><label for="name">Name</label> </dt>
        <dd>
            <input type="text" name="name" id="name" value="<?php echo htmlentities($name); ?>">
            <span class="message error"><?php echo $msgName; ?></span>
        </dd>

        <dt><label for="email">Email</label> </dt>
        <dd>
            <input type="text" name="email" id="email"value="<?php echo htmlentities($email); ?>">
            <span class="message error"><?php echo $msgEmail; ?></span>
        </dd>

        <dt><label for="profession">Profession</label> </dt>
        <dd>
            <select name="profession" id="profession">
                <option value="0"<?php if ($profession === 0) { echo ' selected="selected"'; } ?>>Please select...</option>
                <option value="1"<?php if ($profession === 1) { echo ' selected="selected"'; } ?>>Dingen doen</option>
                <option value="2"<?php if ($profession === 2) { echo ' selected="selected"'; } ?>>Niets doen</option>
                <option value="3"<?php if ($profession === 3) { echo ' selected="selected"'; } ?>>Beeke doen</option>
            </select>
            <span class="message error"><?php echo $msgprofession; ?></span>
        </dd>

        <dt><label>Find via</label></dt>
        <dd>
            <label for="meal0"><input type="checkbox" name="via[]" id="via0" value="Internet"<?php if (in_array('Internet', $via)) { echo ' checked="checked"'; } ?> />Internet</label>
            <label for="meal1"><input type="checkbox" name="via[]" id="via1" value="Vrienden"<?php if (in_array('Vrienden', $via)) { echo ' checked="checked"'; } ?> />Vrienden</label>
            <label for="meal2"><input type="checkbox" name="via[]" id="via2" value="Advertenties"<?php if (in_array('Advertenties', $via)) { echo ' checked="checked"'; } ?> />Advertenties</label>
            <label for="meal2"><input type="checkbox" name="via[]" id="via3" value="Andere"<?php if (in_array('Andere', $via)) { echo ' checked="checked"'; } ?> />Andere</label>
            <span class="message error"><?php echo $msgVia; ?></span>
        </dd>

        <dt><label for="remark">Remark</label></dt>
        <dd>
            <textarea name="remark" id="remark" rows="5" cols="40"><?php echo htmlentities($remark); ?></textarea>
            <span class="message error"><?php echo $msgRemark; ?></span>
        </dd>
        <dt>
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Send" />
            <input type="submit" id="btnCancel" name="btnCancel" value="Cancel" />
        </dt>
    </dl>
</form>
<div>
    <?php
    var_dump($_POST);
    ?>
</div>
</body>

</html>