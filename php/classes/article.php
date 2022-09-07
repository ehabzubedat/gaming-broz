<?php
require_once 'dbClass.php';

// A class that handles all articles data in the database.
class article
{

    // Method that adds a new article to database.
    public function insertArticle($db,$params)
    {
        return $db->execute("INSERT INTO articles (title,content,image,game_id) VALUES (?,?,?,?)",$params);
    }

	// Method that selects all articles from database.
    public function selectAllArticles($db)
    {
        return $db->fetchAll("SELECT * FROM articles");
    }
	
	// Method that select the last published article (the newest article).
    public function selectLatestArticle($db)
    {
        return $db->fetchAll("SELECT * FROM articles ORDER BY date_posted DESC LIMIT 1");
    }
	
	// Method for selecting all articles from the database in the order in which a publication date is descending (from new to old articles).
    public function selectAllArticlesDescByDate($db)
    {
        return $db->fetchAll("SELECT * FROM articles ORDER BY date_posted DESC");
    }
	
    // Method that returns true if article exists in database otherwise returns false.
    public function articleExists($db,$title)
    {
        if($db->fetch("SELECT * FROM articles WHERE title=?",$title,true) > 0)
            return true;
        return false;
    }
    
	// Method that delete article from database (by article ID).
    public function deleteArticle($db,$id)
    {
        return $db->execute("DELETE FROM articles WHERE id=?",array($id));
    }
    
    // Method that delete all articles that belongs to a specific game from data base (by game ID).
    public function deleteArticlesByGameId($db,$id)
    {
        return $db->execute("DELETE FROM articles WHERE game_id=?",array($id));
    }
    
	// Method that select article (by article ID). 
    public function selectArticleById($db,$id)
    {
        return $db->fetch("SELECT * FROM articles WHERE id=?",array($id));
    }
	
	// Method that updates a article data.
    public function updateArticle($db,$query,$params)
    {
        return $db->execute($query,$params);
    }
	
}
?>