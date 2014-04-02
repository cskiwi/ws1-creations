<?php

namespace Ikdoeict\Repository;

class BlogRepository extends \Knp\Repository {

	public function getTableName() {
		return 'blogposts';
	}

	public function find($id) {
		return $this->db->fetchAssoc('SELECT blogposts.*, authors.firstname, authors.lastname from blogposts INNER JOIN authors ON blogposts.author_id = authors.id WHERE blogposts.id = ?', array($id));
	}

	public function findAll() {
		return $this->db->fetchAll('SELECT blogposts.*, authors.firstname, authors.lastname from blogposts INNER JOIN authors ON blogposts.author_id = authors.id');
	}

	public function findAllByAuthor($id) {
		return $this->db->fetchAll('SELECT * from blogposts WHERE author_id = ?', array($id));
	}
    public function findComments($blogpostID){
        return $this->db->fetchAll('SELECT * FROM comments WHERE blogpost_id = ?', array($blogpostID));
    }
}