<?php

namespace Ikdoeict\Repository;

class AuthorsRepository extends \Knp\Repository {

	public function getTableName() {
		return 'authors';
	}

    public function getAuthor($firstname){
        return $this->db->fetchAssoc('SELECT * FROM authors WHERE firstname = ?', array($firstname));
    }

}