<?php
require_once 'dbClass.php';

// A Class that handles all users data in the database.
class user
{
    // Method that insert's a new user to database.
    public function insertUser($db,$params)
    {
        return $db->execute("INSERT INTO users (first_name,last_name,birthday,gender,email,username,password,profile_picture,date_created,type)
			VALUES (?,?,?,?,?,?,?,?,NOW(),'user')",$params);
    }

    // Method for login (checks if username and password that was typed matches the ones that in the database).
    public function login($db,$params,$count=true)
    {
        return $db->fetch("SELECT * FROM users WHERE username=? AND password=?",$params,$count);
    }

	// Method that update's user data.
    public function updateUser($db,$params)
    {
        return $db->execute("UPDATE users SET first_name=?, last_name=?, birthday=?, gender=?, email=?, username=? WHERE id=?",$params);
    }
	
    // Method that select all user data when user logs in.
    public function getUserData($db,$params)
    {
        return $db->fetch("SELECT * FROM users WHERE username=? AND password=?",$params);
    }
	
	// Method that select all data for a specific user from database.
    public function getUserDataById($db,$params)
    {
        return $db->fetch("SELECT * FROM users WHERE id=?",$params);
    }

    // Method that return number of rows of email (checks if email already exist in database).
    public function CheckEmail($db,$params)
    {
        if($db->fetch("SELECT * FROM users WHERE email=?",$params,true) == 0)
            return true;
        return false;
    }
    
    // Method that return true if the email is the users email.
    public function CheckUserEmail($db,$params)
    {
        if($db->fetch("SELECT * FROM users WHERE id=? AND email=?",$params,true) == 1)
            return true;
        return false;
    }
    
    // Method that return number of rows of username (checks if username already exist in database).
    public function CheckUsername($db,$params)
    {
        if($db->fetch("SELECT * FROM users WHERE username=?",$params,true) == 0)
            return true;
        return false; 
    }
	
    // Method that return true if the username is the users username.
    public function CheckUserUsername($db,$params)
    {
        if($db->fetch("SELECT * FROM users WHERE id=? AND username=?",$params,true) == 1)
            return true;
        return false;
    }
    
	// Method that return number of rows of username(check if username already exist in database)
    public function selectUser($db,$username)
    {
        return $db->fetch("SELECT * FROM users WHERE username=?",array($username));
    }
    
    // Method that select all users data from database.
    public function selectAllUsers($db,$id)
    {
        return $db->fetchAllWithParams("SELECT * FROM users WHERE id<>?",array($id));
    }
    
    // Method that search for a user.
	public function searchUser($db,$search_text,$count=false)
	{
        return $db->fetchAll("SELECT * FROM users WHERE first_name LIKE '%".$search_text."%' OR 
        last_name LIKE '%".$search_text."%' OR username LIKE '%".$search_text."%'",$count);
    }
}
?>