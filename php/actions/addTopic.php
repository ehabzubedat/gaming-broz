<?php
require '../init.php';

header( 'Content-type: application/json' );

$response = array();

if ( isset( $_GET['cid'] ) && isset( $_POST['topic'] ) && isset( $_POST['content'] ) ) {
    $cid = $_GET['cid'];
    $user_id = $_SESSION['id'];
    $topic = $_POST['topic'];
    $content = $_POST['content'];

    if ( $forumHndlr->checkTopicTitle( $db, array( $topic ) ) ) {
        $response['status'] = 'error';
        $response['message'] = 'This Topic already exist!';
    } elseif ( $forumHndlr->checkTopicRequestTitle( $db, array( $topic ) ) ) {
        $response['status'] = 'error';
        $response['message'] = 'This topic has been requested already!';
    }
    else {
        if ( $_SESSION['type'] === 'admin' ) {
            if ( $forumHndlr->insertTopic( $db, array( $cid, $user_id, $topic, $content ) ) ) {
                $response['status'] = 'success';
                $response['message'] = 'Your topic has been successfully posted.';
                $response['location'] = 'topics.php?cid='.$cid;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Ops! something went wrong!';
            }
        } else {
            if ( $forumHndlr->insertTopicRequest( $db, array( $cid, $user_id, $topic, $content ) ) ) {
                $response['status'] = 'success';
                $response['message'] = 'Your topic has been requested, it may take a while until it get posted.';
                $response['location'] = 'topics.php?cid='.$cid;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Ops! something went wrong!';
            }
        }
    }
}

echo json_encode( $response );
$db->disconnect();
?>
