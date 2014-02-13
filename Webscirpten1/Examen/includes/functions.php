<?php

	/**
	 * EXAMEN SERVERSIDE WEBSCRIPTEN
	 * @author JE EIGEN NAAM <JE EMAIL>
	 */

    function showDbError($type, $msg) {
    	if (DEBUG) {
    		echo 'ERROR: ' . $msg;
    	}
    	else {
    		file_put_contents(
            __DIR__ . '/error_log_mysql',
            PHP_EOL . (new DateTime())->format('Y-m-d H:i:s') . ' : ' . $msg, FILE_APPEND);
        	header('location: error.php?type=db&detail=' . $type);
        	exit();
    	}
    }





// EOF