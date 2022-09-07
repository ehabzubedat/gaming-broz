<?php 
if (!empty($all_messages)) {
    foreach($all_messages as $m){
        if($_SESSION['id'] === $m['sender']){
            echo '<div class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send" title="'.date("F j, Y, g:i a",strtotime($m['datetime'])).'">'.$m['message'].'</div>
                    <div class="img_cont_msg c-pointer" title="'.$_SESSION['first_name'].'">
                        <a class="link" href="user_profile.php?uid='.$_SESSION['id'].'">
                            <img src="img/uploads/profile pictures/'.$_SESSION['profile_picture'].'" class="link-pic rounded-circle user_img_msg">
                        </a>
                    </div>
                </div>';
            }
            else {
                echo '<div class="d-flex justify-content-start mb-4">
                        <a href="user_profile.php?uid='.$recevier['id'].'">
                            <div class="img_cont_msg c-pointer" title="'.$recevier['first_name'].'">
                                <img src="img/uploads/profile pictures/'.$recevier['profile_picture'].'" class="link-pic rounded-circle user_img_msg">
                            </div>
                        </a>
                        <div class="msg_cotainer" 
                           title="'.date("F j, Y, g:i a",strtotime($m['datetime'])).'">'.$m['message'].'</div>
                    </div>';
            }
    }
}
else {
    echo '<p>Be The First To Start A Conversation !</p>';
}
?>
