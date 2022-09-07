<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
	include "php/includes/themes/header.php";
}

if(isset($_GET['cid']) && !isset($_GET['search'])) {
    // Data
	$cid = $_GET['cid'];
	$categorie = $forumHndlr->selectCategoryById($db,$cid);
    if(empty($categorie)){
        header("Location: forum.php");
    }
	$topics = $forumHndlr->selectAllTopicsByCategoryId($db,$cid);
	$count_topics = $forumHndlr->countTopicsByCategoryId($db,$cid);
}
elseif(isset($_GET['search']) && !isset($_GET['cid'])){
    $search_text = str_replace("+", " ", $_GET['search']);
    $topics = $forumHndlr->searchTopic($db,$search_text);
    $count_topics = $forumHndlr->searchTopic($db,$search_text,true);
}
else {
	header("Location: accessDenied.php");
}
?>

<!-- Main -->
<main>
    <!-- Container -->
    <div class="container forum-container topic-container rounded">
        <!-- Title -->
        <h3 class="text-center rounded  font-weight-bold news-title p-1">
            <?php 
            if(isset($_GET['cid'])){
                echo $categorie['title'];
            } 
            else{
                echo 'Topics';
            }
            ?>
        </h3>
        <hr class="news-title-hr mb-2">
        <!-- /.Title -->
        
        <!-- Search for topic form -->
        <form id="search-topic-form" method="POST">
            <div class="input-group form-2 pl-0 mt-0 mb-0">
                <input id="search-topic-input" class="form-control my-0 py-1 white-border search-topic" type="text" placeholder="Search For A Topic..." aria-label="Search" name="search_text" value="<?php if(isset($_POST['search_text'])) echo $_POST['search_text']?>">
                <div class="input-group-append">
                    <button type="submit" id="search-btn" class="search-btn" name="search-btn">
                        <span class="input-group-text search-box-span" id="search-box-span">
                            <i class="fas fa-search text-grey" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </div>
        </form>
        <!-- ./Search for topic form -->
        
        <hr class="news-title-hr mt-2 mb-2">
        <!-- if there is at least one topic -->
        <?php
        if ( isset( $_GET['cid'] ) ) {
            if ( $count_topics > 0 ) {
                if ( !empty( $_SESSION ) ) {
                    if ( $_GET['cid'] == 3 ) {
                        if ( $_SESSION['type'] === 'admin' ) {
                            echo '<div class="font-weight-bold text-red bg-white p-2 rounded">
                                    <h5 class="pl-2 pt-2">
                                        <a href="addTopic.php?cid='.$cid.'" class="login-link">Add new topic</a>
                                    </h5>
                                </div>';
                        } else {
                            echo "<div class='salert alert-warning col-12 mb-2 p-3 rounded' role='alert'>
                                    Sorry, you don't have permission to add a topic in this category!
                                </div>";
                        }
                    } else if ( $_GET['cid'] == 4 ) {
                        echo "<div class='salert alert-warning col-12 mb-2 p-3 rounded' role='alert'>
                                Sorry, you cannot add topics to this category!
                            </div>";
                    } else {
                       echo '<div class="font-weight-bold text-red bg-white p-2 rounded">
                                <h5 class="pl-2 pt-2">
                                    <a href="addTopic.php?cid='.$cid.'" class="login-link">Add new topic</a>
                                </h5>
                            </div>';
                    }
                } else {
                    echo '<div class="font-weight-bold text-red bg-white p-2 rounded">
                            <h5 class="pl-2 pt-2"><i class="fas fa-sign-in-alt pr-2"></i>
                                Please <a href="login.php" class="login-link">Sign In</a> first to add a topic.
                            </h5>
                        </div>';
                }
                echo '<hr class="topics-hr mt-2">';
                echo '<table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="pl-3">Title</th>
                                                <th scope="col">Posted By</th>
                                                <th scope="col">Date Posted</th>
                                            </tr>
                                        </thead>';
                foreach ( $topics as $t ) {
                    $author = $userHndlr->getUserDataById( $db, array( $t['author_id'] ) );
                    echo '<tr>
                                        <th scope="row">
                                            <h6><a href="topic.php?tid='.$t['id'].'" class="text-white font-weight-bold d-block pt-2">'.$t['title'].'</a></h6>
                                        </th>
                                        <td class="align-middle pl-3">
                                            <a class="link" href="user_profile.php?uid='.$author['id'].'">'.$author['username'].'</a>
                                        </td>
                                        <td class="align-middle">
                                             '.date( "F j, Y", strtotime( $t['date_posted'] ) ).' At  '.date( "g:i a", strtotime( $t['date_posted'] ) ).'
                                        </td>
                                    </tr>';
                }
                echo '</tbody>
                                    </table>';
            } elseif ( $count_topics === 0 ) {
                if ( !empty( $_SESSION ) ) {
                    if ( $_GET['cid'] == 3 ) {
                        if ( $_SESSION['type'] === 'admin' ) {
                            echo '<div class="font-weight-bold text-red bg-white p-2 rounded">
                                    <h5 class="pl-2 pt-2">This category has no topics yet!
                                        <a href="addTopic.php?cid='.$cid.'" class="login-link">Add the very first topic like a boss!</a>
                                    </h5>
                                </div>';
                        } else {
                            echo "<div class='salert alert-warning col-12 mb-2 p-3 rounded' role='alert'>
                                    Sorry, you don't have permission to add a topic in this category!
                                </div>";
                        }
                    } else if ( $_GET['cid'] == 4 ) {
                        echo "<div class='salert alert-warning col-12 mb-2 p-3 rounded' role='alert'>
                                Sorry, you cannot add topics to this category!
                            </div>";
                    } else {
                      echo '<div class="font-weight-bold text-red bg-white p-2 rounded">
                                <h5 class="pl-2 pt-2">This category has no topics yet!
                                    <a href="addTopic.php?cid='.$cid.'" class="login-link">Add the very first topic like a boss!</a>
                                </h5>
                            </div>';
                    }
                } else {
                    echo '<div class="font-weight-bold text-red bg-white p-2 rounded">
                            <h5 class="pl-2 pt-2">
                                <i class="fas fa-sign-in-alt pr-2"></i>
                                Please <a href="login.php" class="login-link">Sign In</a> first to add a topic.
                            </h5>
                        </div>';
                }
            }
        } elseif ( isset( $_GET['search'] ) ) {
            if ( $count_topics > 0 ) {
                echo '<hr class="topics-hr mt-2">';
                echo '<table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="pl-3">Title</th>
                                                <th scope="col">Posted By</th>
                                                <th scope="col">Date Posted</th>
                                            </tr>
                                        </thead>';
                foreach ( $topics as $t ) {
                    $author = $userHndlr->getUserDataById( $db, array( $t['author_id'] ) );
                    echo '<tr>
                                        <th scope="row">
                                            <h6><a href="topic.php?tid='.$t['id'].'" class="text-white font-weight-bold d-block pt-2">'.$t['title'].'</a></h6>
                                        </th>
                                        <td class="align-middle pl-3">
                                            <a class="link" href="user_profile.php?uid='.$author['id'].'">'.$author['username'].'</a>
                                        </td>
                                        <td class="align-middle">
                                             '.date( "F j, Y", strtotime( $t['date_posted'] ) ).' At  '.date( "g:i a", strtotime( $t['date_posted'] ) ).'
                                        </td>
                                    </tr>';
                }
                echo '</tbody>
                                    </table>';
            } else {
                $text = '"'.$search_text.'"';
                echo "<div class='salert alert-warning col-12 mb-2 p-3 rounded' role='alert'>
                                        Sorry, We couldn't find any result matching $text!
                                    </div>";
            }
        }
        ?>
    </div>
    <!-- /.Container -->
</main>
<!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>
