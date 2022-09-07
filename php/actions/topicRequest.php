<?php
require '../init.php';

// Method that redirect access denied page

function access_denied() {
    header( 'Location: ../../accessDenied.php' );
    exit;
}

function accept_success_redirect() {
    header( 'Location: ../../topicRequests.php?status=accept&success=1' );
    exit;
}

function ignore_success_redirect() {
    header( 'Location: ../../topicRequests.php?status=ignore&success=1' );
    exit;
}

function error_redirect() {
    header( 'Location: ../../topicRequests.php?success=0' );
    exit;
}

function sendMail( $to, $subj, $msg ) {
    if ( !empty( $_SESSION ) ) {
        // The receiver
        $mail_to = $to;

        // Sender Data
        $subject = $subj;
        $email_from = 'gamingboz2020@gmail.com';
        $message = $msg;
    }

    $headers = "From: " .$email_from;
    $txt = "You have recieved an e-mail from: Gaming Bro'z Admin.\n\n".$message;

    // Send the email.
    $success = mail( $mail_to, $subject, $txt, $headers );

    // if email sent succesfully
    if ( $success )
    return true;
    return false;
}

if ( !empty( $_SESSION ) ) {
    if ( $_SESSION['type'] == 'admin' ) {
        // check if $_GET id parameter are set
        if ( isset( $_GET['action'] ) && isset( $_GET['id'] ) ) {
            $topic_data = $forumHndlr->selectTopicRequest( $db, $_GET['id'] );
            $id = $topic_data['id'];
            $user_id = $topic_data['author_id'];
            $title = $topic_data['title'];
            if ( $_GET['action'] == 'accept' ) {
                $topic_data = array( $topic_data['category_id'], $topic_data['author_id'], $topic_data['title'], $topic_data['content'] );
                if ( $forumHndlr->acceptTopicRequest( $db, $topic_data, $id ) ) {
                    $user = $userHndlr->getUserDataById( $db, array( $user_id ) );
                    sendMail( $user['email'], 'Your Topic Request Has Been Accepted!', 'Your topic titled('.$title.') has been added to forum for discussion you can now search for it in the forum.' );
                    accept_success_redirect();
                }
            } elseif ( $_GET['action'] == 'ignore' ) {
                if ( $forumHndlr->deleteTopicRequest( $db, $_GET['id'] ) ) {
                    $user = $userHndlr->getUserDataById( $db, array( $user_id ) );
                    sendMail( $user['email'], 'Your Topic Request Has Been Ignored!', 'Your topic titled('.$title.') has been ignored for some reason.');
                    ignore_success_redirect();
                }
            }
            else {
                error_redirect();
            }
        }

    } else {
        access_denied();
    }
} else {
    access_denied();
}