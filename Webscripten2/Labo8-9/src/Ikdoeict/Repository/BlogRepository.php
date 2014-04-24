<?php

namespace Ikdoeict\Repository;

class BlogRepository extends \Knp\Repository {

	public function getTableName() {
		return 'blogposts';
	}

	public function find($id) {
		return $this->db->fetchAssoc('SELECT blogposts.* from blogposts WHERE blogposts.id = ?', array($id));
	}

	public function findForAuthor($id, $authorId) {
		return $this->db->fetchAssoc('SELECT blogposts.* from blogposts WHERE blogposts.id = ? AND author_id = ?', array($id, $authorId));
	}

	public function findAll() {
		return $this->db->fetchAll('SELECT blogposts.*, authors.firstname, authors.lastname from blogposts INNER JOIN authors ON blogposts.author_id = authors.id');
	}

	public function findAllForAuthor($authorId) {
		return $this->db->fetchAll('SELECT blogposts.*, authors.firstname, authors.lastname from blogposts INNER JOIN authors ON blogposts.author_id = authors.id WHERE author_id = ? ORDER BY id DESC', array($authorId));
	}

    public function lastID(){
        return $this->db->lastInsertId();
    }


}