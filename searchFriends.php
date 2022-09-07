<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
    include "php/includes/themes/header.php";
    header("Location: login.php");
}
// All friends
$all_friends = $friendHndlr->select_all_friends($db,$_SESSION['id']);
?>

<!-- Main -->
<main>
    <div class="profile_container">
        <?php 
        /* Profile navbar (with profile pic and username) */
        include "php/includes/themes/profileNav.php"; 
        ?>

        <!-- Search for friend  -->
        <div class="input-group form-2 pl-0 mt-0 mb-0">
            <input id="search-friends" class="form-control my-0 py-1 white-border search-topic" type="text" placeholder="Search For Friends..." aria-label="Search" autocomplete="off">
            <div class="input-group-append">
                <span class="input-group-text search-box-span">
                    <i class="fas fa-search text-grey" aria-hidden="true"></i>
                </span>
            </div>
        </div>
        <!-- ./Search for friend -->

        <hr class="mt-2 mb-2">

        <div class="all_users">
            <div id="friends-search-result" class="usersWrapper"></div>
        </div>
    </div>
</main>
<!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>
