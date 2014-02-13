<?php

	/**
	 * Redirects to the error handling page
	 * @param string $type
	 * @param object $dbhandler
	 * @return void
	 */
	function showDbError($type, $msg) {

		// debug activated
		if (DEBUG === true) {

			switch($type) {

				case 'connect':
				case 'query':
					echo $msg;
				break;

				default:
					echo 'There was an unknown error while communicating with the database';
				break;

			}

		}

		// debug not activated
		else {

			// Log the error
			file_put_contents(ERROR_LOG, $msg . PHP_EOL, FILE_APPEND);

			// The referrerd page will show a proper error based on the $_GET parameters
			header('location: error.php?type=db&detail=' . $type);

		}

		exit();

	}


	/**
	 * Gets the DB connection
	 * @return PDO The DB Connection
	 */
	function getDatabase() {
		try {
            $config = new \Doctrine\DBAL\Configuration();
            $connectionParams = array(
                'dbname' => DB_NAME,
                'user' => DB_USER,
                'password' => DB_PASS,
                'host' => DB_HOST,
                'driver' => 'pdo_mysql',
                'charset' => 'utf8'
            );
            return \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
		} catch (Exception $e) {
			showDbError('connect', $e->getMessage());
		}
	}

// EOF