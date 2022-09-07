<?php
require_once 'dbClass.php';

// A Class that handles all forum data
class forum
{

	// Method that select all forum categories from database.
    public function selectAllForumCategories($db)
    {
        return $db->fetchAll("SELECT * FROM forum_categories");
    }
	
	// Method that counts topics for a specific category.
    public function countTopicsByCategoryId($db,$id)
    {
        return $db->fetch("SELECT * FROM topics WHERE category_id=?",array($id),true);
    }
	
	// Method that returns category data.
    public function selectCategoryById($db,$id)
    {
        return $db->fetch("SELECT * FROM forum_categories WHERE id=?",array($id));
    }
	
	// Method that returns all topics of a specific category.
    public function selectAllTopicsByCategoryId($db,$id)
    {
        return $db->fetchAllWithParams("SELECT * FROM topics WHERE category_id=?",array($id));
    }
	
	// Method that select and return topic data.
    public function selectTopic($db,$id)
    {
        return $db->fetch("SELECT * FROM topics WHERE id=?",array($id));
    }
    
    // Method that returns true if topic already exist in database othewise returns false.
    public function checkTopicTitle($db,$title)
    {
        if($db->fetch("SELECT * FROM topics WHERE title=?",$title,true) > 0)
            return true;
        return false;
    }
    
    // Method that returns true if topic request already exist in database othewise returns false.
    public function checkTopicRequestTitle($db,$title)
    {
        if($db->fetch("SELECT * FROM topic_requests WHERE title=?",$title,true) > 0)
            return true;
        return false;
    }
    
    // Method that select all topic requests from database.
    public function selectAllTopicRequests($db)
    {
        return $db->fetchAll("SELECT * FROM topic_requests");
    }

    // Method that select and return topic request data.
    public function selectTopicRequest($db,$id)
    {
        return $db->fetch("SELECT * FROM topic_requests WHERE id=?",array($id));
    }
    
	// Method that inserts a new topic to database.
	public function insertTopic($db,$params)
	{
        return $db->execute("INSERT INTO topics (category_id,author_id,title,content) VALUES (?,?,?,?)",$params);
    }
    
    // Method that inserts a new topic request to database.
	public function insertTopicRequest($db,$params)
	{
        return $db->execute("INSERT INTO topic_requests (category_id,author_id,title,content) VALUES (?,?,?,?)",$params);
    }
	
    // Method that deletes a topic request from database.
	public function deleteTopicRequest($db,$id)
	{
        return $db->execute("DELETE FROM topic_requests WHERE id=?",array($id));
    }
    
    // Method that accepts (deletes) a topic request from database.
	public function acceptTopicRequest($db,$params,$id)
	{
        if($db->execute("INSERT INTO topics (category_id,author_id,title,content) VALUES (?,?,?,?)",$params)){
            return $db->execute("DELETE FROM topic_requests WHERE id=?",array($id));
        }
    }
    
	// Method that inserts a comment for a specific topic.
	public function insertComment($db,$params)
	{
        return $db->execute("INSERT INTO comments (topic_id,author_id,content) VALUES (?,?,?)",$params);
    }
	
	// Method that count the comment of a specific topic.
	public function countComment($db,$id)
	{
        return $db->fetch("SELECT * FROM comments WHERE topic_id=?",array($id),true);
    }
	
	// Method that select all comment of a specific topic.
	public function selectComments($db,$id)
	{
        return $db->fetchAllWithParams("SELECT * FROM comments WHERE topic_id=?",array($id));
    }
    
    // Method that search for a topic.
	public function searchTopic($db,$search_text,$count=false)
	{
        return $db->fetchAll("SELECT * FROM topics WHERE title LIKE '%".$search_text."%'",$count);
    }
}
?>