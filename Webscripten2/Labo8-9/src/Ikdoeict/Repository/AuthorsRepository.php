<?php

namespace Ikdoeict\Repository;

class AuthorsRepository extends \Knp\Repository {

	public function getTableName() {
		return 'authors';
	}

	public function findAuthorByEmail($email) {
		return $this->db->fetchAssoc('SELECT * FROM '. $this->getTableName() . ' WHERE email = ?', array($email));
	}

}