<?php
require_once 'dbClass.php';

class post
{
    // Method that adds a post to database
    public function insertpost($db,$params)
    {
        return $db->execute("INSERT INTO posts (description) VALUES (?)",$params);
    }
    
}
?>