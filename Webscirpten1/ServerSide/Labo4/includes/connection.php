<?php
/**
 * User: Glenn
 * Date: 14/10/13
 */
try {
    $db = new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (Exception $e) {
    showDbError('connect', $e->getMessage());
}
