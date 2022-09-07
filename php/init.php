<?php
session_start();
session_regenerate_id(true);

require 'classes/dbClass.php';
require 'classes/user.php';
require 'classes/game.php';
require 'classes/article.php';
require 'classes/forum.php';
require 'classes/friend.php';
require 'classes/message.php';
require 'classes/post.php';

// Database Connection
$db = new dbClass();

// User handler
$userHndlr = new user();

// Game handler
$gameHndlr = new game();

// Article handler
$articleHndlr = new article();

// Forum handler
$forumHndlr = new forum();

// Friend handler
$friendHndlr = new friend();

// Message handler
$messageHndlr = new message();

// Post hamdler
$postHndlr = new post();
?>