<?php
require_once 'dbClass.php';

// A Class that handles all messages in the database.
class message
{
    // Method that adds a message to database (send a message).
    public function insertMessage($db,$params)
    {
        return $db->execute("INSERT INTO messages (sender,recevier,message) VALUES (?,?,?)",$params);
    }
    
    // Method that select all message that sent for a specefic user.
    public function selectAllMessages($db,$params)
    {
        return $db->fetchAllWithParams("SELECT * FROM messages WHERE sender=? AND recevier=? or sender=? AND recevier=?",$params);
    }
}
?>