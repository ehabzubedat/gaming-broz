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
if(isset($_GET['rid'])) {
    $recevier = $userHndlr->getUserDataById($db,array($_GET['rid']));
    $all_messages = $messageHndlr->selectAllMessages($db,array($_SESSION['id'],$_GET['rid'],$_GET['rid'],$_SESSION['id']));
}
// All friends
$all_friends = $friendHndlr->select_all_friends($db,$_SESSION['id']);
// Number of friends
$friends_num = $friendHndlr->count_friends($db,$_SESSION['id']);
?>

<!-- Main -->
<main>
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100 mt-4">
            <div class="col-md-4 col-xl-3 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card chat-border">
                    <div class="card-header">
                        <p class="p-0 m-0 text-center messages-title">Messages</p>
                    </div>
                    <div class="card-body contacts_body">
                        <div class="card-body contacts_body">
                            <ui class="contacts">
                                <?php
                    if($friends_num > 0){
                        foreach($all_friends as $row){
                            echo '<a href="messages.php?rid='.$row['id'].'">
                                    <li class="active c-pointer">
                                        <div class="d-flex bd-highlight">
                                            <div class="img_cont">
                                                <img src="img/uploads/profile pictures/'.$row['profile_picture'].'" class="rounded-circle user_img">
                                            </div>
                                            <div class="user_info pt-2">
                                                <span>'.$row['username'].'</span>
                                            </div>
                                        </div>
                                    </li>
                                </a>';
                        }
                    }
                    else{
                        echo '<h4>You have no friends :(</h4>';
                    }
                    ?>
                            </ui>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-md-8 col-xl-6 chat">
                <div class="card contacts_card chat-border">
                    <?php if (!empty($recevier)): ?>
                    <div class="card-header msg_head chat-border">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont c-pointer">
                                <a href="user_profile.php?uid=<?= $recevier['id'] ?>">
                                    <img src="img\uploads\profile pictures\<?= $recevier['profile_picture'] ?>" class="link-pic rounded-circle user_img">
                                </a>
                            </div>
                            <div class="user_info c-pointer pt-2">
                                <a class="h-underline" href="user_profile.php?uid=<?= $recevier['id'] ?>">
                                    <span><?= $recevier['username'] ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="scroll-messages" class="card-body msg_card_body chat-border">
                        <div id="chat-messages"><?php include "displayMessages.php"; ?></div>
                    </div>
                    <div class="card-footer chat-border">
                        <form id="chat-form" action="php/actions/sendMessage.php?rid=<?= $_GET['rid'] ?>" method="POST">
                        <div class="input-group">
                            <textarea id="message" class="form-control type_msg" name="message" placeholder="Type your message..."></textarea>
                            <div id="send-message" class="input-group-append">
                                <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                            </div>
                        </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>
