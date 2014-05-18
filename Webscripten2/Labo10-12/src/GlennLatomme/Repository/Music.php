<?php

namespace GlennLatomme\Repository;

class Music extends \Knp\Repository {

    public function getTableName() {
        return 'albums';
    }

    public function findAll($curPage = 1, $numItemsPerPage = 10){
        return $this->db->fetchAll('
        SELECT albums.id, albums.title, albums.released, artists.title as artist_name
        from albums
        INNER JOIN artists ON albums.artist_id = artists.id
        ORDER by albums.title ASC
        LIMIT ' . (int) (($curPage - 1) * $numItemsPerPage) . ',' .
            (int) ($numItemsPerPage)
        );


    }

    public function lastID(){
        return $this->db->lastInsertId();
    }

    public function countAlbums(){
        return $this->db->fetchColumn('SELECT COUNT(*) FROM ' . $this->getTableName());
    }

    public function getGenres(){
        return array_map('current',$this->db->fetchAll('SELECT genres.title FROM genres'));
    }


}