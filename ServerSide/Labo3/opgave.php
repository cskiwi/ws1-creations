<?php

/**
 * Lab 03, Exercise 2 — Start File
 * @author Bramus Van Damme <bramus.vandamme@kahosl.be>
 */

// vars
$basePath = __DIR__ . DIRECTORY_SEPARATOR . 'images'; // C:\wamp\www\vn.an\labo03\images
$baseUrl = 'images'; // images
$images = array(); // An array which will hold all our images
$di = new DirectoryIterator($basePath);
$captions = new SPLFileObject($basePath .DIRECTORY_SEPARATOR .'captions.txt');
$addCaption = isset($_POST['addCaption']) ? (string) $_POST['addCaption'] : '';
$msgCaption = '';
$msgImage = '';
$msgGeneral = '';
$continue = true;



if (isset($_FILES['addImage'])) {

    // check if caption is filled in
    if (trim($addCaption) == ''){
        $msgCaption = 'no caption added';
        $continue = false;
    }

    // check if an image is attached
    if ($_FILES['addImage']['size'] <= 0) {
        $msgImage = 'no images added';
        $continue = false;
    }

    if ($continue) {
        /*
            echo '<p>Uploaded file: ' . $_FILES['addImage']['name'] . '</p>';
            echo '<p>_Template location: ' . $_FILES['addImage']['tmp_name'] . '</p>';
            echo '<p>Size: ' . $_FILES['addImage']['size'] . '</p>';*/

        if (!in_array((new SplFileInfo($_FILES['addImage']['name']))->getExtension(), array('jpeg', 'jpg', 'png', 'gif'))) {
            exit('<p>Invalid extension. Only .jpeg, .jpg, .png or .gif allowed</p>');
        }
        if(!file_exists($basePath .DIRECTORY_SEPARATOR .$_FILES['addImage']['name'])) {
            file_put_contents($basePath .DIRECTORY_SEPARATOR .'captions.txt', $addCaption . PHP_EOL, FILE_APPEND);
            move_uploaded_file($_FILES['addImage']['tmp_name'], $basePath .DIRECTORY_SEPARATOR .$_FILES['addImage']['name']) or die('<p>Error while saving file in the uploads folder</p>');
            header('Location: '.$_SERVER['PHP_SELF']);
        } else
            $msgGeneral = 'filename already exists';
    }
}

foreach ($di as $file) {
    if (!$file->isDot() && in_array($file->getExtension(), array('jpeg', 'jpg', 'png', 'gif'))) {
        $fi = new SplFileObject($baseUrl . DIRECTORY_SEPARATOR .$file);
        array_push($images, array(
                'url' => $fi->getPathName(),
                'caption' => $captions->current())
        );
        $captions->next();
    }
}


?><!doctype html>
<html>
<head>
    <title>Images</title>
    <meta charset="utf-8" />
    <style>

        body {
            font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", sans-serif;
            font-weight: 300;
            font-size: 14px;
            line-height: 1.2;
            background: #FCFCFC;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        li {
            display:  block;
            width: 310px;
            height: 310px;
            float: left;
            border: 1px solid #ccc;
            margin: 20px;
            position: relative;
            box-shadow: 0 0 20px #CCC;

        }

        li img {
            max-width: 100%;
        }

        li .caption {
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 5px;
            color: #000;
            background: rgba(255,255,255,0.9);
            border-top: 1px solid #ccc;
            text-shadow: 1px 1px 1px #fff;
        }

        li:hover {
            box-shadow: 0 0 20px #999;
        }

        .error {
            color: red;
        }

    </style>
</head>
<body>
<ul>
    <?php
    foreach ($images as $image) {
        echo '		<li><img src="' . $image['url'] . '" alt="' . htmlentities($image['caption']) . '" title="' . htmlentities($image['caption']) . '" /><span class="caption">' . htmlentities($image['caption']) . '</span></li>' . PHP_EOL;
    }
    ?>
    <li>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" >
            <span class="message error"><?php echo $msgGeneral; ?></span><br />

            <input type="file" name="addImage" id="addImage" /> <br />
            <span class="message error"><?php echo $msgImage; ?></span>  <br />


            <label for="addCaption">Caption</label> <input type="textfield" name="addCaption" id="addCaption"/><br />
            <span class="message error"><?php echo $msgCaption; ?></span><br />
            <input type="submit" />
        </form>
    </li>
</ul>

</body>
</html>