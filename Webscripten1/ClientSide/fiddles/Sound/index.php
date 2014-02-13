<!doctype html>
<html>
<head>
    <style type="text/css">
        * {
            margin: 0px;
            padding: 0px;
        }
        body {
            background:#002D3C;
        }

        #wrapper {
            position: fixed;
            width: 100%;
            height: 100%;
        }
        #animation {
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
        }
        #playlist {
            position: fixed;
            top: 0; left: 0;
            height: 100%;
            width: 30%;
            overflow: auto;
        }
        #playlist ul {
            list-style: none;
            margin: 5px;
        }
        #playlist a,
        #playlist a:visited{
            color: #FFFFCC;
        }
        #songInfo {
            color: #FFFFCC;
        }

        #mp3_player{
            margin: 0 auto;
            width:500px;
            height:60px;
            padding:5px;
            z-index: 5;
        }
        #mp3_player > div > audio{
            width:500px;
        }
        #mp3_player > canvas#analyser_render{
            width:500px;
            height:30px;
        }

    </style>
    <script>


    </script>
</head>
<body>
<div id="wrapper">
    <div id="mp3_player">
        <div id="audio_box">
            <span id="songInfo">track</span>
        </div>
        <canvas id="analyser_render"></canvas>
    </div>
    <div id="playlist">
        <ul id="songs">
            <?php
            $songs = glob('Songs/*.mp3');
            for($i = 0; $i < count($songs); $i++){
                echo '<li><a href="#" songID="'.$i.'" data-src="'.$songs[$i].'">Track '.($i +1) .'</a></li>';
            }
            ?>
        </ul>
    </div>

</div>
<script type="text/javascript" src="jquery-2.0.3.min.js">   </script>
<script type="text/javascript" src="script.js">   </script>
<script src="id3-minimized.js" type="text/javascript"></script>
</body>
</html>