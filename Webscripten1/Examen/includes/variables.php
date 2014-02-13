<?php
/**
 * User: Glenn Latomme
 * Date: 30/01/14
 */

/**
 * Genres
 */

$stmt = $db->prepare('SELECT * FROM genres');
$stmt->execute();
$genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

/**
 * Cookies
 */
if(isset($_SESSION['username'])&& $_SESSION['username'] != null) {
    $user = $_SESSION['username'];
} else {
    $user = null;
}