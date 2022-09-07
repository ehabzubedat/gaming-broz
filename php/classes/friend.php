<?php
require_once 'dbClass.php';

// A class that handles all friend data in the database.
class friend
{

    // Method that checks if two users are already friends.
    public function check_if_friends($db,$params)
    {
        $count = $db->fetch("SELECT * FROM friends WHERE (user_one=? AND user_two=?) OR (user_one=? AND user_two=?)",$params,true);

        if($count === 1) {
            return true;
        }
        else {
            return false;
        } 
    }

    // Method that checks if the user is the sender or the reciver.
    public function check_if_sender_or_reciver($db,$params)
    {
        $count = $db->fetch("SELECT * FROM friend_request WHERE sender=? AND receiver=?",$params,true);

        if($count === 1) {
            return true;
        }
        else {
            return false;
        }
    }

    // Method that checks if request has already been sent. 
    public function request_already_sent($db,$params)
    {
        $count = $db->fetch("SELECT * FROM friend_request WHERE (sender=? AND receiver=?) OR (sender=? AND receiver=?)",$params,true);

        if($count === 1) {
            return true;
        }
        else {
            return false;
        } 
    }

    // Method that send a friend request.
    public function send_friend_request($db,$params)
    {
        return $db->execute("INSERT INTO friend_request (sender, receiver) VALUES (?,?)",$params);
    }

    // Method that cancels or ignores the friend request.
    public function cancel_or_ignore_friend_request($db,$params)
    {
        return $db->execute("DELETE FROM friend_request WHERE (sender=? AND receiver=?) OR (sender=? AND receiver=?)",$params);
    }

    // Method that makes two user's friends.
    public function make_friends($db,$params,$my_id,$user_id)
    {
        if($db->execute("DELETE FROM friend_request WHERE (sender=? AND receiver=?) OR (sender=? AND receiver=?)",$params)){
            return $db->execute("INSERT INTO friends (user_one, user_two) VALUES(?, ?)",array($my_id,$user_id));
        }
    }

    // Method that delete a friend.  
    public function delete_friend($db,$params)
    {
        return $db->execute("DELETE FROM friends WHERE (user_one=? AND user_two=?) OR (user_one=? AND user_two=?)",$params);
    }

    // Method that counts the Friend requests for The receiver.
    public function request_notification($db,$id,$count)
    {
        return $db->fetchAllWithParams("SELECT sender, username, profile_picture FROM friend_request JOIN users ON friend_request.sender = users.id WHERE receiver=?",array($id),$count);
    }
    
    // Method that count number of friends for a specific user.
    public function count_friends($db,$id)
    {
        return $db->fetchAllWithParams("SELECT * FROM friends WHERE user_one=? OR user_two=?",array($id,$id),true);
    }
    
    // Method that returns all friends for a specific user.
    public function select_all_friends($db,$id)
    {
        $return_data = [];
        $all_users = $db->fetchAllWithParams("SELECT * FROM friends WHERE user_one=? OR user_two=?",array($id,$id));
        
        foreach($all_users as $row){
            if($row['user_one'] == $id){
                $get_user = "SELECT id, username, profile_picture FROM users WHERE id=?";
                array_push($return_data, $db->fetch($get_user,array($row['user_two'])));
            }
            else{
                $get_user = "SELECT id, username, profile_picture FROM users WHERE id=?";
                array_push($return_data, $db->fetch($get_user,array($row['user_one'])));
            }
        }
        
        return $return_data;
    }
    
}
?>