<?php
/**
 * User: Glenn
 * Date: 30/09/13
 */
$name = isset($_POST['name']) ? (string) $_POST['name'] : '';
$productNames = array();

$msgName = '*';
$currentProduct = 0;

while(isset($_POST['product'.$currentProduct])){
    array_push($productNames,$_POST['product'.$currentProduct]);
    $currentProduct++;
}
$amount = 1;
if (isset($_POST['amount']))
    if (is_numeric($_POST['amount']))
        $amount = $_POST['amount'];

if (isset($_POST['btnAddProduct']))
    $amount++;

else if(isset($_POST['btnSubmit'])){
    $allOk = true;

    // name
    if (trim($name) === '') {
        $msgName = 'Please enter your name';
        $allOk = false;
    }

    if ($allOk === true) {
        $gotoLocation = 'Location: Opgave_6b.php?name='. urlencode($name);
        for($i = 0; $i < $amount; $i++)
            $gotoLocation  .= '&'. urlencode('Product'.$i) . '='. urlencode($productNames[$i]);
        echo $gotoLocation;
        header($gotoLocation);
    }
}
?>


<html>
<head>
    <meta charset="UTF-8" />
    <title>
        Opgave 6
    </title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <dl>
        <dt><label for="name">Name</label> </dt>
        <dd>
            <input type="text" name="name" id="name" value="<?php echo htmlentities($name); ?>">
            <span class="message error"><?php echo $msgName; ?></span>
        </dd>
        <?php
            for ($i = 0; $i < $amount; $i++){
                echo '<dt><label for="product">Product ';
                echo $i+1;
                echo ':</label> </dt>';
                echo '<dd><input type="text" name="product'.$i.'" id="product'.$i.'" value="';
                echo isset($_POST['product'.$i])? $productNames[$i] : '';
                echo '"></dd>';
            }
        ?>


        <dt>
            <input type="submit" id="btnAddProduct" name="btnAddProduct" value="Add Product" />
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Send" />
        </dt>

        <hr/ >
        <input type="hidden" name="amount" id="amount" value="<?php echo $amount; ?>" />
    </dl>
</form>
<div>
    <?php
    var_dump($_POST);
    ?>
</div>
</body>

</html>