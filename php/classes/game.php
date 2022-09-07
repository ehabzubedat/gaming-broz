<?php
require_once 'dbClass.php';

// A Class that handels all games data in the database.
class game
{
    // Method that select all games from database.
    public function selectAllGames($db)
    {
        return $db->fetchAll("SELECT * FROM games");
    }
	
	// Method that select all games from database in ascending order.
    public function selectAllGamesAsc($db)
    {
        return $db->fetchAll("SELECT * FROM games ORDER BY name");
    }

    // Method that select data for a specific game from database.
    public function selectGameById($db,$id)
    {
        return $db->fetch("SELECT * FROM games WHERE id=?",array($id));
    }

    // Method that select data for a specific game from database.
    public function gameExists($db,$name)
    {
        if($db->fetch("SELECT * FROM games WHERE name=?",$name,true) > 0)
            return true;
        return false;
    }
    
    // Method that adds a new game to database.
    public function insertGame($db,$params)
    {
        return $db->execute("INSERT INTO games (name,download_link,trailer_link,photo) VALUES (?,?,?,?)",$params);
    }

    // Method that delete a specific game from database.
    public function deleteGame($db,$id)
    {
        return $db->execute("DELETE FROM games WHERE id=?",array($id));
    }

    // Method that updates game data.
    public function updateGame($db,$query,$params)
    {
        return $db->execute($query,$params);
    }

}
?>