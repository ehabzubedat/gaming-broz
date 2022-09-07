<?php

switch (basename($_SERVER['PHP_SELF'])) {
    case "index.php":
        echo "Home";
        break;
    case "news.php":
	case "displayArticle.php":
        echo "News";
        break;
    case "article.php":
        echo "Article";
        break;
    case "forum.php":
	case "topics.php":
        echo "Forum";
        break;
	case "contact_us.php":
        echo "Contact us";
        break;
	case "login.php":
        echo "Login";
        break;
	case "signup.php":
        echo "Sign up";
        break;
	case "account.php":
        echo "Account";
        break;
	case "gameRegistration.php":
	case "articleRegistration.php":
	case "games.php":
	case "articles.php":
	case "editArticle.php":
	case "editGame.php":
    case "topicRequests.php":
		echo "Management";
        break;
	case "addTopic.php":
		echo "Add Topic";
        break;
	case "topic.php":
		echo "Topic";
        break;
    case "user_profile.php":
		echo $user_data['username'];
        break;
    case "myFriends.php":
		echo "Friends";
        break;
    case "friendRequests.php":
		echo "Friend Requests";
        break;
    case "searchFriends.php":
		echo "Search Friends";
        break;
    case "messages.php":
        echo "Messages";
        break;
}
?>